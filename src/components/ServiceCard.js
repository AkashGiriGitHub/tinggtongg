import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Typography from '@material-ui/core/Typography';
import Paper from '@material-ui/core/Paper';

const useStyles = makeStyles({
  root: {
    borderRadius:'20px',
    width:'100%',
    height:300,
    padding:'50px',
    marginBottom:'10px',
    background: "linear-gradient(#51CFA0 , #F2F1EB)" 
  },
  media: {
    alignContent:"center",
    height: 50,
    width:50,
    display: "inline-block"
  },
  content:{
    fontSize:20,
    color:'#104a61'
  }
});

export default function ServiceCard(props) {
  const classes = useStyles();

  return (
    <>
    <Card className={classes.root}>
    <CardActionArea>
      <h2 className={classes.content}>{props.content}</h2>
        <CardMedia
          className={classes.media}
          image={props.image}
          title={props.content}
        ></CardMedia>
            <Typography>{props.servicesText}</Typography>
    </CardActionArea>
    </Card>
    <Typography>      
    </Typography>
    </>
  );
}
