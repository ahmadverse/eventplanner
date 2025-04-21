# Modern AI Chatbot

A modern, responsive chatbot application built with Flask and Groq AI, featuring multiple themes and a beautiful user interface.

## Features

- Modern and responsive UI
- Multiple theme options (Light, Dark, Blue, Purple)
- Markdown support for bot responses
- Real-time loading animations
- Persistent theme selection
- Mobile-friendly design

## Prerequisites

- Python 3.8 or higher
- Groq API key

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd chatbot
```

2. Create and activate a virtual environment:
```bash
python -m venv venv
# On Windows:
.\venv\Scripts\activate
# On Unix or MacOS:
source venv/bin/activate
```

3. Install the required packages:
```bash
pip install -r requirements.txt
```

4. Create a `.env` file in the root directory and add your Groq API key:
```
GROQ_API_KEY=your_api_key_here
```

## Running the Application

1. Make sure your virtual environment is activated
2. Run the Flask application:
```bash
python app.py
```
3. Open your browser and navigate to `http://localhost:5000`

## Usage

1. Select your preferred theme using the theme selector in the top-right corner
2. Type your message in the input field
3. Press Enter or click the send button to send your message
4. The bot will respond with formatted text (supports markdown)

## Technologies Used

- Frontend:
  - HTML5
  - CSS3
  - JavaScript
  - Bootstrap 5
  - Font Awesome
  - Marked.js (for markdown parsing)
- Backend:
  - Flask
  - Groq AI
  - Python-dotenv

## License

MIT License 