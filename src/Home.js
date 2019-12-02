import React, { Component } from 'react';
import { Link } from 'react-router-dom';


export default class Home extends Component {
    render() {
        return (
            <div className="">
                <p className="display-4">Hello World!</p><br/>
                <Link to="/login" className="btn btn-outline-dark">Login</Link>&nbsp;&nbsp;
                <Link to="/register" className="btn btn-dark">Register</Link>
            </div>
        );
    }
}

