import React from 'react';
import pic5 from '../assets/images/Picture5.png';
import pic6 from '../assets/images/Picture6.png';
import pic7 from '../assets/images/Picture7.png';
import pic8 from '../assets/images/Picture8.png';
import { Container, Row, Col } from 'react-bootstrap';
import MediaCard from './MediaCard';

export const weAreBestComponent = <Container style={{ padding: '50px' }}>
  <Row>
    <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h2 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>Why We Are Best!</h2></Col>
  </Row>
  <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
    <Col s={12} lg={3}>
      <MediaCard image={pic5} content='Safe & Hygienic' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic6} content='Warranty & Replacement' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic7} content='Free Pick & Drop' />
    </Col>
    <Col s={12} lg={3}>
      <MediaCard image={pic8} content='Trusted Professionals' />
    </Col>
  </Row>
</Container>;
