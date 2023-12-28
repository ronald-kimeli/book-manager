// userState.js
import { reactive } from 'vue';

const userState = reactive({
  user: null,
  token: null,
});

export function setUser(newUser) {
  userState.user = newUser.user;
  userState.token = newUser.token;
}

export function getUser() {
  return userState.user;
}

export function getToken() {
  return userState.token;
}

export default userState;
