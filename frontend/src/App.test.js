import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import App from './App';

jest.mock('./proto/echo_grpc_web_pb', () => ({
  EchoServiceClient: jest.fn(),
}));

jest.mock('./proto/echo_pb', () => ({
  EchoRequest: jest.fn().mockImplementation(() => ({
    setMessage: jest.fn(),
  })),
}));

describe('App', () => {
  test('renders App component without crashing', () => {
    render(<App />);
    expect(screen.getByText('Echo Express')).toBeInTheDocument();
    expect(screen.getByText('Send a message to the server and receive the echo')).toBeInTheDocument();
    expect(screen.getByPlaceholderText('Enter a message')).toBeInTheDocument();
    expect(screen.getByText('Send')).toBeInTheDocument();
  });

  test('allows the user to type into the input box', () => {
    render(<App />);
    userEvent.type(screen.getByPlaceholderText('Enter a message'), 'Test message');
    expect(screen.getByPlaceholderText('Enter a message')).toHaveValue('Test message');
  });
});