import React from 'react';
import Details from './Details'
import Home from './Home'
import Register from '../../Auth/js/Register'
import Login from '../../Auth/js/Login'
import 'antd/dist/antd.css'; 
import { BrowserRouter as Router, Route, Redirect, RouteProps } from 'react-router-dom';


const App = () => {
    return (
        <Router>
            <Route path='/category/login' component={Login} ></Route>
            <Route path='/category/register' component={Register} ></Route>
            <Route path='/category/dt' component={Details} ></Route>
            <Route exact path='/category' component={Home} ></Route>
        </Router >
    )
}

export default App;

