import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Typography from '@material-ui/core/Typography';
import Rating from '@material-ui/lab/Rating';

const useStyles = makeStyles({
  root: {
    borderRadius:'20px',
    width:'100%',
    height:150,
    marginTop:20,
    background: "linear-gradient(#51CFA0 , #F2F1EB)" 
  },
  media: {
    alignContent:"center",
    height: 50,
    width:50,
    display: "inline-block",
    padding:'2%'
  },
  content:{
    fontSize:20,
    color:'#104a61'
  }
});

export default function MediaCard(props) {
  const classes = useStyles();

  return (
    <>
    <Card className={classes.root}>
    <CardActionArea>
      <CardMedia className={classes.content}>{props.custName}</CardMedia>
        <CardMedia
          className={classes.media}
          image={props.image}
          title={props.content}
        />
        <Rating name="half-rating-read" defaultValue={props.rating} precision={0.5} readOnly />
        <CardMedia>{props.content}</CardMedia>
    </CardActionArea>
    </Card>
    </>
  );
}
