import React from 'react';
import { Form,Container,Button,Row,Col } from 'react-bootstrap';
import booking from '../assets/images/booking.jpg'
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios'

const  Confirm =(props)=>{
const detail=props.location.state.detail
    return (
      // {
      //   "name": "Akash Sudesh Giri",
      //   "phoneNo": "+918378809034",
      //   "email": "akash.giri.09jul1989@gmail.com",
      //   "address": "Prithvi Enclave\n601",
      //   "issues": "Test"
      // }

      <Container style={{marginTop:'5%'}}>
        <Row>
        <Col style={{ textAlign: 'center'}}>
        <h1 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>Order Confirmed</h1>
        </Col>
        </Row>
        <Row>
        <Col style={{ textAlign: 'left'}}>
          <label>Name : {detail.name}</label>
        </Col>
        </Row>
        <Row>
        <Col style={{ textAlign: 'left'}}>
          <label>Phone No : {detail.phoneNo}</label>
        </Col>
        </Row>
        <Row>
        <Col style={{ textAlign: 'left'}}>
          <label>Email : {detail.email}</label>
        </Col>
        </Row>
        <Row>
        <Col style={{ textAlign: 'left'}}>
          <label>Address : {detail.address}</label>
        </Col>
        </Row>
        <Row>
        <Col style={{ textAlign: 'left'}}>
          <label>Issues : {detail.issues}</label>
        </Col>
        </Row>

      </Container>
    );
  }


export default Confirm;