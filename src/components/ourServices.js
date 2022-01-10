import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import SwipeableTextMobileStepper from './SwipeableTextMobileStepper';

export const ourServices = <Container style={{ paddingTop: '50px' }}>
  <Row>
    <Col style={{ textAlign: 'center', color: "rgb(3 127 121)" }}><h2 style={{ color: 'rgb(3 127 121)',fontSize:25 }}>Our Laptop Repair Services</h2></Col>
  </Row>

  <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
    <Col>
      <SwipeableTextMobileStepper />
    </Col>
  </Row>
</Container>;
