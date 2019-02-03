/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow
 * @lint-ignore-every XPLATJSCOPYRIGHT1
 */

import React, { Component } from 'react';
import { Platform, StyleSheet, View, TextInput, Button, Alert } from 'react-native';
import { Login } from "../ParkSmart/components/Login";
import {
  StackNavigator,
} from 'react-navigation';

const App = StackNavigator({
  Home: { screen: HomeScreen },
  Login: { screen: Login },
});

class HomeScreen extends React.Component {
  static navigationOptions = {
    title: 'Welcome',
  };
  render() {
    const { navigate } = this.props.navigation;
    return (
      <Button
        title="Go to Jane's profile"
        onPress={() =>
          navigate('Profile')
        }
      />
    );
  }
}
const url = "http://172.23.0.57:8000"
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
