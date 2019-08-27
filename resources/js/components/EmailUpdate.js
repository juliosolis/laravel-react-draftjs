import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {Editor, EditorState, convertToRaw, RichUtils, getDefaultKeyBinding} from 'draft-js';

export default class EmailUpdate extends Component {
    constructor(props) {
        super(props);
        this.state = {
            subject: '',
            editorState: EditorState.createEmpty(),
            msg: '',
            errors: {
                'subject': false,
                'body': false
            }
        };

        this.focus = () => this.refs.editor.focus();

        this.handleChangeSubject = this.handleChangeSubject.bind(this);
        this.onChangeEditor = this.onChangeEditor.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

        // Draftjs rich text editor
        this.handleKeyCommand = this._handleKeyCommand.bind(this);
        this.mapKeyToEditorCommand = this._mapKeyToEditorCommand.bind(this);
        this.toggleBlockType = this._toggleBlockType.bind(this);
        this.toggleInlineStyle = this._toggleInlineStyle.bind(this);
    }

    _handleKeyCommand(command, editorState) {
        const newState = RichUtils.handleKeyCommand(editorState, command);
        if (newState) {
            this.onChangeEditor(newState);
            return true;
        }
        return false;
    }

    _mapKeyToEditorCommand(e) {
        if (e.keyCode === 9 /* TAB */) {
            const newEditorState = RichUtils.onTab(
                e,
                this.state.editorState,
                4, /* maxDepth */
            );
            if (newEditorState !== this.state.editorState) {
                this.onChangeEditor(newEditorState);
            }
            return;
        }
        return getDefaultKeyBinding(e);
    }

    _toggleBlockType(blockType) {
        this.onChangeEditor(
            RichUtils.toggleBlockType(
                this.state.editorState,
                blockType
            )
        );
    }

    _toggleInlineStyle(inlineStyle) {
        this.onChangeEditor(
            RichUtils.toggleInlineStyle(
                this.state.editorState,
                inlineStyle
            )
        );
    }

    handleChangeSubject(e) {
        const newSubject = e.target.value;
        this.setState(prevState => {
            return {
                subject: newSubject,
                errors:
                    {
                        ...prevState.errors,
                        subject: newSubject.length > 0 ? false : true
                    }
            }
        });
    }

    onChangeEditor(editorState) {
        let currentContent = editorState.getCurrentContent();
        // console.log(currentContent);
        // console.log(convertToRaw(currentContent));
        this.setState({editorState});
    };

    handleSubmit(e) {
        e.preventDefault();
        axios.post('/email/save', {
            subject: this.state.subject,
            body: JSON.stringify({
                content: convertToRaw(this.state.editorState.getCurrentContent()),
            })
        })
            .then(res => {
                this.setState({
                    subject: '',
                    editorState: EditorState.createEmpty(),
                    msg: 'Your emails was successful saved!'
                });

                setTimeout(function () {
                    this.setState({msg: ''});
                }.bind(this), 5000);
            })
            .catch(error => {
                this.setState({
                    errors: error.response.data.errors
                });
            });
    }

    componentDidMount() {
        axios.get('/email/view/' + this.state.id).then(response => {
            this.setState({news: response.data});
        }).catch(error => {
            console.log(error);
        });
    }

    render() {
        const {editorState} = this.state;
        let className = 'RichEditor-editor';

        return (
            <form onSubmit={this.handleSubmit}>

                <div className={"alert alert-success " + (this.state.msg == '' ? 'd-none' : '')}>
                    {this.state.msg}
                    <button type="button" className="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div className="form-group">
                    <label>Subject:</label>
                    <input
                        className={"form-control " + (this.state.errors.subject ? 'is-invalid' : '')}
                        onChange={this.handleChangeSubject}
                        value={this.state.subject}
                        type="text"/>
                    <div className="invalid-feedback">
                        Please type a subject.
                    </div>
                </div>
                <div className={className} onClick={this.focus}>
                    <BlockStyleControls
                        editorState={editorState}
                        onToggle={this.toggleBlockType}
                    />
                    <InlineStyleControls
                        editorState={editorState}
                        onToggle={this.toggleInlineStyle}
                    />
                    <Editor
                        blockStyleFn={getBlockStyle}
                        customStyleMap={styleMap}
                        editorState={editorState}
                        // handleKeyCommand={this.handleKeyCommand}
                        // keyBindingFn={this.mapKeyToEditorCommand}
                        onChange={this.onChangeEditor}
                        placeholder="Write your email..."
                        ref="editor"
                        spellCheck={true}
                    />
                </div>
                <button type="submit" className="btn btn-primary">Submit</button>
            </form>
        );
    }
}

// Custom overrides for "code" style.
const styleMap = {
    CODE: {
        backgroundColor: 'rgba(0, 0, 0, 0.05)',
        fontFamily: '"Inconsolata", "Menlo", "Consolas", monospace',
        fontSize: 16,
        padding: 2,
    },
};

function getBlockStyle(block) {
    switch (block.getType()) {
        case 'blockquote':
            return 'RichEditor-blockquote';
        default:
            return null;
    }
}

class StyleButton extends React.Component {
    constructor() {
        super();
        this.onToggle = (e) => {
            e.preventDefault();
            this.props.onToggle(this.props.style);
        };
    }

    render() {
        let className = 'RichEditor-styleButton';
        if (this.props.active) {
            className += ' RichEditor-activeButton';
        }
        return (
            <span className={className} onMouseDown={this.onToggle}>
              {this.props.label}
            </span>
        );
    }
}

const BLOCK_TYPES = [
    {label: 'H1', style: 'header-one'},
    {label: 'H2', style: 'header-two'},
    {label: 'H3', style: 'header-three'},
    {label: 'H4', style: 'header-four'},
    {label: 'H5', style: 'header-five'},
    {label: 'H6', style: 'header-six'},
    {label: 'Blockquote', style: 'blockquote'},
    {label: 'UL', style: 'unordered-list-item'},
    {label: 'OL', style: 'ordered-list-item'},
    {label: 'Code Block', style: 'code-block'},
];
const BlockStyleControls = (props) => {
    const {editorState} = props;
    const selection = editorState.getSelection();
    const blockType = editorState
        .getCurrentContent()
        .getBlockForKey(selection.getStartKey())
        .getType();
    return (
        <div className="RichEditor-controls">
            {BLOCK_TYPES.map((type) =>
                <StyleButton
                    key={type.label}
                    active={type.style === blockType}
                    label={type.label}
                    onToggle={props.onToggle}
                    style={type.style}
                />
            )}
        </div>
    );
};
let INLINE_STYLES = [
    {label: 'Bold', style: 'BOLD'},
    {label: 'Italic', style: 'ITALIC'},
    {label: 'Underline', style: 'UNDERLINE'},
    {label: 'Monospace', style: 'CODE'},
];
const InlineStyleControls = (props) => {
    const currentStyle = props.editorState.getCurrentInlineStyle();

    return (
        <div className="RichEditor-controls">
            {INLINE_STYLES.map((type) =>
                <StyleButton
                    key={type.label}
                    active={currentStyle.has(type.style)}
                    label={type.label}
                    onToggle={props.onToggle}
                    style={type.style}
                />
            )}
        </div>
    );
};

if (document.getElementById('emailUpdate')) {
    const element = document.getElementById('emailUpdate');
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<EmailUpdate {...props}/>, document.getElementById('emailUpdate'));
}
