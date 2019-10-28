import axios from 'axios';

const baseDomain = 'http://someproject.local';
const baseURL = `${baseDomain}/api`;

export default axios.create({
  baseURL,
  headers: {
    Accept: 'application/json',
    // "Authorization":
  },
});
