import React from 'react';
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import  ReactDOM  from "react-dom";
import Login from "./Login";
import Register from "./Register";
import 'antd/dist/antd.css';

const App = () => {
    return (
        <Router>
            <Switch>
                <Route path="/auth/login" component={Login} />
                <Route path="/auth/register" component={Register} />
            </Switch>
        </Router>
    )
}

ReactDOM.render(<App />, document.getElementById('root'));

