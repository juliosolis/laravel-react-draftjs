import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import {convertToRaw} from "draft-js";

export default class Example extends Component {
    constructor() {
        super();
        this.state = {
            subject: '',
            body: '',
            msg: '',
            errors: {
                'subject': false,
                'body': false
            }
        };
        this.handleChangeSubject = this.handleChangeSubject.bind(this);
        this.handleChangeBody = this.handleChangeBody.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
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

    handleChangeBody(e) {
        const newBody = e.target.value;
        this.setState(prevState => {
            return {
                body: newBody,
                errors:
                    {
                        ...prevState.errors,
                        body: newBody.length > 0 ? false : true
                    }
            }
        });
    }

    handleSubmit(e) {
        e.preventDefault();
        axios.post('/email/save', {
            subject: this.state.subject,
            body: this.state.body
        })
            .then(res => {
                this.setState({
                    subject: '',
                    body: '',
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

    }

    render() {
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
                <div className="form-group">
                    <label>Body:</label>
                    <textarea
                        className={"form-control " + (this.state.errors.body ? 'is-invalid' : '')}
                        onChange={this.handleChangeBody}
                        value={this.state.body}
                    ></textarea>
                    <div className="invalid-feedback">
                        Body could not be empty
                    </div>
                </div>
                <button type="submit" className="btn btn-primary">Submit</button>
            </form>
        );
    }
}

if (document.getElementById('demo')) {
    ReactDOM.render(<Example/>, document.getElementById('demo'));
}
