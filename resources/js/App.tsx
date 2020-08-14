import React, { useState } from 'react';
import { makeStyles, createStyles } from '@material-ui/core';
import Box from '@material-ui/core/Box';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import '../css/App.css';

const useStyles = makeStyles(() => 
    createStyles({
        shortenInput: {
            width: '75%',
            height: '56px',
        },
        shortenButton: {
            width: '25%',
            height: '56px',
        }
    })
)

function Shorten() {
    const classes = useStyles();

    const [isShorted, setIsShorted] = useState(false);
    const [url, setUrl] = useState('');

    function handleShorternInputChange(event: React.ChangeEvent<HTMLInputElement>) {
        setUrl(event.target.value);
    }
        
    function handleShortenClick() {
        setUrl('http://shorted.test/a1b2c3');
        setIsShorted(true);
    }

    function handleCopyClick() {
        // TODO
    }

    return (
        <Box className="m-b-md">
            <TextField 
                className={classes.shortenInput}
                variant="outlined"
                placeholder="Shorten your link"
                onChange={handleShorternInputChange}
                value={url}
            />
            <Button 
                className={classes.shortenButton}
                variant="contained"
                color="primary"
                onClick={isShorted ? handleCopyClick : handleShortenClick}
            >{ isShorted ? 'Copy!' : 'Shorten'}</Button>
        </Box>
    );
}

export default function App() {
    return (
        <React.Fragment>
            <CssBaseline />
            <div className="flex-center position-ref full-height">
                <div className="content">
                    <h1 className="title">Shorter URL</h1>
                    <Shorten />
                </div>
        </div>
        </React.Fragment>
    );
}