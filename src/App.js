import React, {Component} from 'react';
import Login from './Login';
import { Route, Switch } from 'react-router-dom';
import Home from './Home';
import Register from './Register';

export default class App extends Component{
    render(){
    	return (
	        
	            <Switch>
					<Route exact path="/" component={Home} />
					<Route path="/login" component={Login} />
					<Route path="/register" component={Register} />

				</Switch>
	        
	    );
    }
}

