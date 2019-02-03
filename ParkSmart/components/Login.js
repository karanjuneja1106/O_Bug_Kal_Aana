import React, { Component } from 'react';
import { AppRegistry, Text, TextInput, View } from 'react-native';
import { url } from "../App";
export default class App extends Component {
    constructor(props) {
        super(props);
        this.state = { username: null, password: null }
    }
    onSubmit = () => {
        console.log(this.state);
        return fetch(`${url}/api/Accounts/loginUser/`, {
            method: "POST",
            headers: {
                Accept: 'application/vnd.api+json',
                'Content-Type': 'application/vnd.api+json'
            },
            body: JSON.stringify(this.state)
        })
            .then((response) => {
                return response.json()
            })
            .then((responseJson) => {
                console.log(responseJson);
                if (responseJson.data === '1') {
                    Alert.alert("logged in");
                    this.props.navigation
                }

                return responseJson;
            })
            .catch((error) => {
                Alert.alert("sorry");
            });
    }
    render() {
        return (
            <View style={{ padding: 10 }} >
                <TextInput
                    style={{ height: 40 }}
                    placeholder="Enter Username"
                    onChangeText={(username) => this.setState({ username })}
                />
                <TextInput
                    style={{ height: 40 }}
                    type="password"
                    placeholder="Enter Password"
                    onChangeText={(password) => this.setState({ password })}
                />
                <Button
                    onPress={this.onSubmit}
                    title="Submit "
                    color="#841584"
                    accessibilityLabel="Learn more about this purple button"
                />
            </View >
        );
    }
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: '#F5FCFF',
    },
    welcome: {
        fontSize: 20,
        textAlign: 'center',
        margin: 10,
    },
    instructions: {
        textAlign: 'center',
        color: '#333333',
        marginBottom: 5,
    },
});
