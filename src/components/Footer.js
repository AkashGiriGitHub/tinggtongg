import 'bootstrap/dist/css/bootstrap.min.css';
import FooterCard from './FooterCard'
import {Container, Row, Col} from 'react-bootstrap';

export default function Footer(){
    return <Container style={{paddingBottom:'100px'}}>
    <Row className="justify-content-md-center" style={{ textAlign: 'center' }}>
      <Col s={12} lg={4}>
        <FooterCard image={null} content='ABOUT TINGGTONGG' 
        servicesText1="We are a dedicated team that believes in providing reliable and best laptop Repair services to each and every doorstep in Mumbai." />
      </Col>
      <Col s={12} lg={4}>
      <FooterCard image={null} content='OUR SERVICES' 
        servicesText1='Laptops & Desktop Repair Doorstep Service Buy New Laptops & PC Same Day Delivery'/>
      </Col>
      <Col s={12} lg={4}>
      <FooterCard image={null} content='CORPORATE OFFICE' 
        servicesText1="Room no.1 Shankar mandir gate, opposite shiv sena office, Mumbra, Thane, Maharashtra 400612" />
      </Col>
    </Row>
  </Container>
  
}