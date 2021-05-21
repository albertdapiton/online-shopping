import React from 'react';
import {Redirect, Route, withRouter} from 'react-router-dom';

let stateOfState = localStorage["appState"];

if (! stateOfState){
    let appState = {
        isLoggedIn: false,
        user: {}
    };
    localStorage["appState"] = JSON.stringify(appState);
}

let state = localStorage["appState"];
let appState = JSON.parse(state);

const auth = {
    isLoggedIn: appState.isLoggedIn,
    user: appState
};

const PrivateRoute = ({ component: Component, path, ...rest }) => (
    <Route path={path}
       {...rest}
       render={props => Auth.isLoggedIn ? 
            (<Component {...props} />) : (<Redirect to={{
                pathname: "/login",
                state: {
                    prevLocation: path,
                    error: "You need to login first!",
                },
            }}
            />)
        }
    />
);

export default withRouter(PrivateRoute);