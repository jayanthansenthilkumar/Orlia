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

// Set current year in footer
document.getElementById('currentYear').textContent = new Date().getFullYear();

// Highlight active navigation link based on scroll position
document.addEventListener('DOMContentLoaded', function() {
    // Chatbot functionality
    const chatbotButton = document.querySelector('.chatbot-button');
    const chatbotBox = document.querySelector('.chatbot-box');
    const closeChat = document.querySelector('.close-chat');
    const sendButton = document.querySelector('.send-message');
    const chatInput = document.querySelector('.chatbot-input input');
    const messagesContainer = document.querySelector('.chatbot-messages');
    
    // Toggle chatbot display with smooth animation
    chatbotButton.addEventListener('click', function() {
        // Remove display:none style and add active class
        chatbotBox.style.removeProperty('display');
        
        // Force a reflow to ensure the transition works
        void chatbotBox.offsetWidth;
        
        // Add active class to trigger animation
        chatbotBox.classList.add('active');
        
        // Hide button with animation
        chatbotButton.style.transform = 'scale(0)';
        chatbotButton.style.opacity = '0';
        
        // After animation completes, set display:none
        setTimeout(() => {
            chatbotButton.style.display = 'none';
        }, 300);
        
        // Focus on input after animation completes
        setTimeout(() => {
            chatInput.focus();
        }, 400);
    });
    
    // Close chatbot with smooth animation
    closeChat.addEventListener('click', function() {
        // Start closing animation
        chatbotBox.classList.remove('active');
        
        // Show button with animation
        chatbotButton.style.display = 'flex';
        
        // Force a reflow
        void chatbotButton.offsetWidth;
        
        // Animate button back in
        chatbotButton.style.transform = 'scale(1)';
        chatbotButton.style.opacity = '1';
        
        // After animation completes, hide chatbot
        setTimeout(() => {
            chatbotBox.style.display = 'none';
        }, 300);
    });
    
    // Send message function
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message.length === 0) return;
        
        // Add user message
        addMessage(message, 'user');
        chatInput.value = '';
        
        // Show typing indicator
        const typingIndicator = showTypingIndicator();
        
        // Simulate bot response after delay
        setTimeout(() => {
            // Remove typing indicator
            messagesContainer.removeChild(typingIndicator);
            
            const responses = [
                "Thanks for your message! Our team will get back to you soon.",
                "Orlia'25 will be held on April 3-4, 2025 at MKCE Campus.",
                "You can register for events on our website starting January 2025.",
                "For more information, please contact us at projectstih@gmail.com.",
                "We're looking forward to seeing you at Orlia'25!"
            ];
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            addMessage(randomResponse, 'bot');
        }, 1500);
    }
    
    // Add message to chat with animation
    function addMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', type);
        
        // Create message header with avatar and timestamp
        const messageHeader = document.createElement('div');
        messageHeader.classList.add('message-header');
        
        // Add avatar
        const avatar = document.createElement('div');
        avatar.classList.add('message-avatar');
        
        if (type === 'bot') {
            avatar.innerHTML = '<i class="ri-robot-line"></i>';
        } else {
            avatar.innerHTML = '<i class="ri-user-line"></i>';
        }
        
        // Add timestamp
        const timestamp = document.createElement('span');
        timestamp.classList.add('message-time');
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        timestamp.textContent = `${hours}:${minutes}`;
        
        // Build message header based on type
        if (type === 'user') {
            messageHeader.appendChild(timestamp);
            messageHeader.appendChild(avatar);
        } else {
            messageHeader.appendChild(avatar);
            messageHeader.appendChild(timestamp);
        }
        
        // Add message text
        const messagePara = document.createElement('p');
        messagePara.textContent = message;
        
        // Assemble message
        messageDiv.appendChild(messageHeader);
        messageDiv.appendChild(messagePara);
        messagesContainer.appendChild(messageDiv);
        
        // Scroll to the bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Apply animation
        setTimeout(() => {
            messageDiv.style.opacity = '1';
            messageDiv.style.transform = 'translateY(0)';
        }, type === 'user' ? 0 : 300);
    }
    
    // Update existing messages to have header and timestamp
    function updateExistingMessages() {
        const existingMessages = document.querySelectorAll('.chatbot-messages .message');
        existingMessages.forEach(msg => {
            const type = msg.classList.contains('bot') ? 'bot' : 'user';
            if (!msg.querySelector('.message-header')) {
                const pElement = msg.querySelector('p');
                if (pElement) {
                    const messageContent = pElement.textContent;
                    msg.innerHTML = '';
                    
                    // Create message header with avatar and timestamp
                    const messageHeader = document.createElement('div');
                    messageHeader.classList.add('message-header');
                    
                    // Add avatar
                    const avatar = document.createElement('div');
                    avatar.classList.add('message-avatar');
                    
                    if (type === 'bot') {
                        avatar.innerHTML = '<i class="ri-robot-line"></i>';
                    } else {
                        avatar.innerHTML = '<i class="ri-user-line"></i>';
                    }
                    
                    // Add timestamp
                    const timestamp = document.createElement('span');
                    timestamp.classList.add('message-time');
                    const now = new Date();
                    const hours = now.getHours().toString().padStart(2, '0');
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    timestamp.textContent = `${hours}:${minutes}`;
                    
                    // Build message header based on type
                    if (type === 'user') {
                        messageHeader.appendChild(timestamp);
                        messageHeader.appendChild(avatar);
                    } else {
                        messageHeader.appendChild(avatar);
                        messageHeader.appendChild(timestamp);
                    }
                    
                    // Add message text
                    const messagePara = document.createElement('p');
                    messagePara.textContent = messageContent;
                    
                    // Assemble message
                    msg.appendChild(messageHeader);
                    msg.appendChild(messagePara);
                }
            }
        });
    }
    
    // Call function to update existing messages when page loads
    updateExistingMessages();
    
    // Send message on button click
    sendButton.addEventListener('click', sendMessage);
    
    // Send message on Enter key
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    // Handle navigation for mobile
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Close mobile menu if it exists
            const mobileMenu = document.querySelector('.mobile-menu');
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
            }
        });
    });
    
    // Update the typing indicator function
    function showTypingIndicator() {
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'message bot typing-indicator';
        const typingDots = document.createElement('p');
        typingDots.innerHTML = '<span></span><span></span><span></span>';
        typingIndicator.appendChild(typingDots);
        messagesContainer.appendChild(typingIndicator);
        
        // Scroll to the bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        return typingIndicator;
    }
});

function updateEvents() {
    const daySelection = document.getElementById('daySelection');
    const eventsDropdown = document.getElementById('events');

    eventsDropdown.innerHTML = '<option value="" disabled selected>Select Event</option>';

    eventsDropdown.disabled = false;

    if (daySelection.value === 'day1') {
        const day1Events = [
            { value: 'paper_presentation', text: 'Paper Presentation' },
            { value: 'technical_quiz', text: 'Technical Quiz' },
            { value: 'coding_competition', text: 'Coding Competition' },
            { value: 'project_expo', text: 'Project Expo' }
        ];

        day1Events.forEach(event => {
            const option = document.createElement('option');
            option.value = event.value;
            option.textContent = event.text;
            eventsDropdown.appendChild(option);
        });
    } else if (daySelection.value === 'day2') {
        const day2Events = [
            { value: 'hackathon', text: 'Hackathon' },
            { value: 'debate', text: 'Technical Debate' },
            { value: 'workshop', text: 'Workshop' },
            { value: 'gaming', text: 'Gaming Competition' }
        ];

        day2Events.forEach(event => {
            const option = document.createElement('option');
            option.value = event.value;
            option.textContent = event.text;
            eventsDropdown.appendChild(option);
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const eventsDropdown = document.getElementById('events');
    if (eventsDropdown) {
        eventsDropdown.disabled = true;
    }
});