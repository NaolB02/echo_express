import './App.css';
import React, { useState } from 'react';
import {EchoServiceClient} from './proto/echo_grpc_web_pb';
import {EchoRequest} from './proto/echo_pb';

const client = new EchoServiceClient('http://localhost:8080', null, null);

function App() {
  const [msg, setMsg] = useState('');
  const [rsp, setRsp] = useState('');

  const sendMessage = () => {
    const request  = new EchoRequest();
    request.setMessage(msg);

    client.echoBack(request, {}, (err, response) => {
      if(err) {
        console.log(err);
        setRsp("Error");
        return;
      }

      setRsp(response.getMessage());
    });
  }

  return (
    <>
      <div className="App-header">
        <h1>Echo Express</h1>
        <h2>Send a message to the server and receive the echo</h2>
      </div>
      <div className="bg-image"></div>
      <div className="App">
        <input
          type="text"
          value={msg}
          onChange={(e) => setMsg(e.target.value)}
          placeholder="Enter a message"
        />
        <button onClick={sendMessage}>Send</button>
        {rsp && <p>{rsp}</p>}
      </div>
    </>
  );
}

export default App;
