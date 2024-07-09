import axios from 'axios';


  
const API_URL = 'http://localhost:8000/api/funis';

export const getFunis = () => {
  return axios.get(API_URL);
};

export const createFunil = (data) => {
  return axios.post(API_URL, data);
};

export const updateFunil = (id, data) => {
  return axios.put(`${API_URL}/${id}`, data);
};

export const deleteFunil = (id) => {
  return axios.delete(`${API_URL}/${id}`);
};