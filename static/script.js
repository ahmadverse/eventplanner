document.addEventListener('DOMContentLoaded', () => {
    const chatForm = document.getElementById('chatForm');
    const userInput = document.getElementById('userInput');
    const chatMessages = document.getElementById('chatMessages');
    const themeDropdown = document.querySelector('.dropdown-menu');

    // Theme switching
    themeDropdown.addEventListener('click', (e) => {
        if (e.target.classList.contains('dropdown-item')) {
            const theme = e.target.getAttribute('data-theme');
            document.body.className = `theme-${theme}`;
            localStorage.setItem('preferred-theme', theme);
        }
    });

    // Load saved theme
    const savedTheme = localStorage.getItem('preferred-theme') || 'light';
    document.body.className = `theme-${savedTheme}`;

    // Add loading animation
    function createLoadingAnimation() {
        const loading = document.createElement('div');
        loading.className = 'message bot-message';
        loading.innerHTML = `
            <div class="message-content">
                Thinking<span class="loading">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </div>
        `;
        return loading;
    }

    // Add message to chat
    function addMessage(content, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        
        // Parse markdown in bot responses
        if (!isUser) {
            messageContent.innerHTML = marked.parse(content);
        } else {
            messageContent.textContent = content;
        }
        
        messageDiv.appendChild(messageContent);
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Handle form submission
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const message = userInput.value.trim();
        
        if (!message) return;

        // Add user message
        addMessage(message, true);
        userInput.value = '';

        // Add loading animation
        const loadingDiv = createLoadingAnimation();
        chatMessages.appendChild(loadingDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        try {
            const response = await fetch('/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            
            // Remove loading animation
            chatMessages.removeChild(loadingDiv);

            if (data.error) {
                addMessage('Sorry, there was an error processing your request. Please try again.');
            } else {
                addMessage(data.response);
            }
        } catch (error) {
            // Remove loading animation
            chatMessages.removeChild(loadingDiv);
            addMessage('Sorry, there was an error connecting to the server. Please try again.');
        }
    });

    // Handle Enter key
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
}); 