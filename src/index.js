import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import { BrowserRouter as Router } from 'react-router-dom';


function Index() {
    return (
        <div className="">
            <App />
        </div>
    );
}

export default Index;

if (document.getElementById('index')) {
    ReactDOM.render(<Router><Index /></Router>, document.getElementById('index'));
}
