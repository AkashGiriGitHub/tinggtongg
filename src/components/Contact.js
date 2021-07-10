import React, { Component } from 'react';
import { Form,Container,Button,Row,Col } from 'react-bootstrap';
import booking from '../assets/images/booking.jpg'
import 'bootstrap/dist/css/bootstrap.min.css';
import { Typography } from '@material-ui/core';

class Contact extends Component {
  render() {
    return (<Container style={{marginTop:'5%'}}>
    <Row>
    <Col xs={12} lg={6}>
    <div className="hideMobile">  
    <img
        className="d-block w-100"
        src={booking}
        alt="Laptop Repair Booking"/>
    </div>    
    </Col>
    <Col xs={12} lg={5}>
    <Typography>
      Contact
    </Typography>
    </Col>
    </Row>
  </Container>
    );
  }
}

export default Contact;