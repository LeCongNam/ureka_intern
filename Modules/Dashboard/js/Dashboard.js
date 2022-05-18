import React from 'react';
import { BrowserRouter as Router } from "react-router-dom";
import  ReactDOM  from "react-dom";
import 'antd/dist/antd.css';
import Admin from './Admin';

const Dashboard = () => {
    return (
        <Router>
            <Admin/>
        </Router>
      
    )
}

ReactDOM.render(<Dashboard />, document.getElementById('root'));

