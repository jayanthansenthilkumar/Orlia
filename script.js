// Add smooth scrolling for anchor links
document.querySelectorAll('.nav-links a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Chatbot functionality
const chatbotButton = document.querySelector('.chatbot-button');
const chatbotBox = document.querySelector('.chatbot-box');
const closeChat = document.querySelector('.close-chat');
const sendMessage = document.querySelector('.send-message');
const messageInput = document.querySelector('.chatbot-input input');
const messagesContainer = document.querySelector('.chatbot-messages');

// Improved bot responses
const botResponses = {
    greeting: [
        "Hello! 👋 How can I help you today?",
        "Hi there! Welcome to Orlia'25. What would you like to know? 😊",
        "Greetings! I'm here to assist you with information about Orlia'25. 🎉"
    ],
    events: [
        "Orlia'25 will be held on April 3-4, 2025 at MKCE Campus. We have various cultural and technical events planned! 🎭",
        "Our main events include:\n• Cultural performances\n• Technical workshops\n• Competitions\nWould you like specific details? 🎯"
    ],
    location: [
        "The event will take place at MKCE Campus, Karur. 📍\nNeed directions?",
        "You can find us at MKCE Campus, Karur. Let me know if you need help with directions! 🗺️"
    ],
    registration: [
        "Registration details will be announced soon. Stay tuned! 📢\nWould you like to know about early bird registrations?",
        "You can register through our upcoming registration portal. Want me to notify you when it's live? 📝"
    ],
    default: [
        "I'm here to help with information about Orlia'25. Would you like to know about our events or registration? 🤔",
        "Could you please rephrase that? I can help you with:\n• Event details\n• Registration\n• Venue information\n• Schedule 📋",
        "Let me connect you with our team for more specific information. Meanwhile, can I tell you about our exciting events? 🎪"
    ]
};

// Initialize chatbot state
let isChatbotOpen = false;

// Toggle chatbot with improved handling
chatbotButton.addEventListener('click', () => {
    chatbotBox.style.display = 'block';
    // Force a reflow
    chatbotBox.offsetHeight;
    chatbotBox.classList.add('active');
    isChatbotOpen = true;
});

closeChat.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    chatbotBox.classList.remove('active');
    setTimeout(() => {
        chatbotBox.style.display = 'none';
    }, 300);
    isChatbotOpen = false;
});

// Prevent document click from closing chatbot
document.addEventListener('click', (e) => {
    if (isChatbotOpen && !chatbotBox.contains(e.target) && !chatbotButton.contains(e.target)) {
        closeChat.click();
    }
});

// Prevent chatbot clicks from bubbling
chatbotBox.addEventListener('click', (e) => {
    e.stopPropagation();
});

// Enhanced response handling
function getBotResponse(message) {
    message = message.toLowerCase();
    
    // Multiple keyword checking for better matching
    const keywords = {
        greeting: ['hi', 'hello', 'hey', 'good', 'morning', 'evening', 'afternoon'],
        events: ['event', 'program', 'schedule', 'workshop', 'competition', 'cultural', 'technical'],
        location: ['where', 'location', 'place', 'venue', 'direction', 'map', 'reach'],
        registration: ['register', 'registration', 'join', 'participate', 'apply', 'form', 'sign']
    };

    // Check each keyword category
    for (const [category, words] of Object.entries(keywords)) {
        if (words.some(word => message.includes(word))) {
            return getRandomResponse(botResponses[category]);
        }
    }

    // Check for partial matches
    const allWords = message.split(' ');
    for (const word of allWords) {
        for (const [category, words] of Object.entries(keywords)) {
            if (words.some(keyword => keyword.includes(word) || word.includes(keyword))) {
                return getRandomResponse(botResponses[category]);
            }
        }
    }

    return getRandomResponse(botResponses.default);
}

// Improved message handling
function sendChatMessage() {
    const message = messageInput.value.trim();
    if (message === '') return;

    // Add user message
    addMessage('user', message);
    messageInput.value = '';

    // Show typing indicator
    const typingIndicator = document.createElement('div');
    typingIndicator.className = 'message bot typing';
    typingIndicator.innerHTML = '<p>Typing...</p>';
    messagesContainer.appendChild(typingIndicator);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Generate bot response with delay
    setTimeout(() => {
        messagesContainer.removeChild(typingIndicator);
        const response = getBotResponse(message);
        addMessage('bot', response);
    }, Math.random() * 500 + 500); // Random delay between 500ms and 1000ms
}

// Add message to chat
function addMessage(type, message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;
    messageDiv.innerHTML = `<p>${message}</p>`;
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Event listeners
sendMessage.addEventListener('click', sendChatMessage);
messageInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendChatMessage();
    }
});

// Current year for footer
document.getElementById('currentYear').textContent = new Date().getFullYear();
