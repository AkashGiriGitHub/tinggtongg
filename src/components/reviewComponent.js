import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import Review from './Review';

export const reviewComponent = <Container style={{ padding: '50px' }}>
  <Row>
    <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h2 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>Happy Clients of our Laptop Repair in Mumbai</h2></Col>
  </Row>
  <Review />
</Container>;
