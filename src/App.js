import './App.css';
import React from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import Home from './components/Home';
import About from './components/About';
import Contact from './components/Contact';
import PersistentDrawerLeft from './components/PersistentDrawerLeft'
import Booking from './components/Booking'
import Footer from './components/Footer';
function App() {
  return (
    <Router>
    <div>
    <PersistentDrawerLeft/>
      <Switch>
          <Route exact path='/' component={Home} />
          <Route path='/contact' component={Contact} />
          <Route path='/about' component={About} />
          <Route path='/book' component={Booking} /> 
      </Switch>
    <Footer></Footer>
    </div>
  </Router>
  );
}

export default App;
