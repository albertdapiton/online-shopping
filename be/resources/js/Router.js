import React from 'react';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';

import Home from './components/Home/Home';
import Login from './views/Login/Login';
import Register from './views/Register/Register';
import NotFound from './views/NotFound/NotFound';

import PrivateRoute from './PrivateRoute'
import Dashboard from './views/user/Dashboard/Dashboard';

const Main = props => (
    <Switch>
        <Route exact path='/' component={props => <Home {...props} />} />
        <Route path='/login' component={props => <Login {...props} />} />
        <Route path='/register' component={props => <Register {...props} />} />
        <PrivateRoute path='/dashboard' component={props => <Dashboard {...props} />} />
        <Route component={props => <NotFound {...props} />} />
    </Switch>
);

export default Main;