import React from 'react';
import pic1 from '../assets/images/Picture1.png';
import pic2 from '../assets/images/Picture2.png';
import pic3 from '../assets/images/Picture3.png';
import pic4 from '../assets/images/Picture4.png';
import { Container, Row, Col } from 'react-bootstrap';
import MediaCard from './MediaCard';

export const howItWorkComponent = <Container style={{ padding: '50px' }}>
  <Row>
    <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h2 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>How It Works!</h2></Col>
  </Row>
  <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
    <Col s={12} lg={3}>
      <MediaCard image={pic1} content='Tell Requirement' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic2} content='Enter Details' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic3} content='Doorstep Service' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic4} content='Pay After Service' />
    </Col>
  </Row>
</Container>;
