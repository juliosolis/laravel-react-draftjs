import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class Example extends Component {
    constructor() {
        super();
        this.state = {
            news: [],
            msg: 'Hi SendFox'
        };
    }

    componentDidMount() {
        this.setState({
            news: [
                {
                    'id': 1,
                    'name': 'Julio',
                    'age': 35,
                },
                {
                    'id': 2,
                    'name': 'Nesla',
                    'age': 34,
                }
                ,
                {
                    'id': 3,
                    'name': 'Jr',
                    'age': 8,
                }
                ,
                {
                    'id': 4,
                    'name': 'Yulia',
                    'age': 2,
                }
            ]
        });
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>

                            <div className="card-body">
                                {this.state.msg}

                                {
                                    this.state.news.map(user =>
                                        <div key={user.id}>
                                            <h4>{user.name}</h4>
                                            <p>Age: {user.age}</p>
                                        </div>)
                                }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example/>, document.getElementById('example'));
}
