
    document.getElementById('close-button').addEventListener('click', () => {
  chatWindow.style.display = 'none';
});

    const chatIcon = document.getElementById('chat-icon');
    const chatWindow = document.getElementById('chat-window');
    const chatHistory = document.getElementById('chat-history');
    const userMessageInput = document.getElementById('user-message');
    const sendMessageButton = document.getElementById('send-button');

    let currentProduct = null; // Store the current product context
    let followUpTimeout = null; // Timeout reference to manage follow-up messages

    const products = [
      {
        name: "Bournvita",
        type: "Chocolate Malt Beverage Mix",
        brand: "Cadbury",
        mixingInstructions: "Mix 2-3 tablespoons of Bournvita powder with a glass (200ml) of hot or cold milk.",
        servingSize: "One serving is typically 2-3 tablespoons of Bournvita powder with 200ml of milk.",
        protein: {
          value: "3-4 grams",
          source: "https://www.mynetdiary.com/food/calories-in-bournvita-by-cadbury-lb-12013287-0.html"
        },
        nutrition: {
          carbohydrates: "Primary source of energy",
          sugars: "Added sugars (amount varies)",
          fat: "Low amount",
          vitaminsMinerals: "Vitamin D, Vitamin B12, Iron, Calcium"
        },
        calories: {
          value: "150-200 calories (estimate)",
          source: "https://www.mynetdiary.com/food/calories-in-bournvita-by-cadbury-lb-12013287-0.html"
        },
        additionalInfo: [
          "Not a complete meal replacement, consume as part of a balanced diet.",
          "Consult a healthcare professional before consuming if you have health concerns.",
          "May contain allergens, check the label before consumption.",
          "Disclaimer: This information is for general knowledge only, consult a healthcare professional for specific advice."
        ],
        sources: ["https://www.mynetdiary.com/food/calories-in-bournvita-by-cadbury-lb-12013287-0.html"]
      }
    ];

    addMessageToChat("Hello! How can I help you today?", "chatbot");
    displayProductOptions();

    sendMessageButton.addEventListener('click', sendMessage);
    userMessageInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    chatIcon.addEventListener('click', () => {
      chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
    });
    function sendMessage() {
    const userMessage = userMessageInput.value.trim().toLowerCase();
    if (userMessage) {
        userMessageInput.value = "";
        addMessageToChat(userMessage, "user");
        clearTimeout(followUpTimeout); // Clear previous timeout

        // Show the typing indicator before displaying the response
        const typingIndicator = addMessageToChat("<div class='col-3'><div class='snippet' data-title='dot-typing'><div class='stage'><div class='dot-typing'></div></div></div></div>", "chatbot");
        setTimeout(() => {
            chatHistory.removeChild(typingIndicator); // Remove typing indicator
            processUserMessage(userMessage);
        }, 3000); // Simulate a delay of 2 seconds
    }
}


function processUserMessage(userMessage) {
    const inputParts = userMessage.split(' ');

    // If there's a current product, try to match property first
    if (currentProduct) {
        const propertyMatch = Object.keys(currentProduct).find(key =>
          inputParts.some(part => formatPropertyName(key).toLowerCase().replace(/\s+/g, '') === part)
        );
        if (propertyMatch) {
            addMessageToChat(`${formatPropertyName(propertyMatch)}: ${formatPropertyContent(currentProduct[propertyMatch])}`, 'chatbot');
            return; // Exit early since we found a property
        }
    }

    // Check for new product match
    let foundProduct = inputParts.map(part =>
        products.find(p => p.name.toLowerCase() === part)
    ).find(p => p); // Find the first matching product

    if (foundProduct) {
        currentProduct = foundProduct;
        displayProductProperties(foundProduct);
        scheduleFollowUpMessage();
    } else {
        addMessageToChat("Sorry, I couldn't understand that. Could you please specify the product or property you're interested in?", "chatbot");
    }
}

    function scheduleFollowUpMessage() {
        followUpTimeout = setTimeout(() => {
            addMessageToChat("Do you have any other questions or need further assistance?", "chatbot");
        }, 10000);
    }

    function addMessageToChat(message, sender) {
    const messageContainer = document.createElement('div');
    messageContainer.classList.add('message-container', sender);

    const headerContainer = document.createElement('div');
    headerContainer.classList.add('header-container');

    const icon = document.createElement('img');
    icon.src = sender === 'chatbot' ? 'https://cdn-icons-png.freepik.com/128/8943/8943377.png' : 'https://cdn-icons-png.freepik.com/128/11461/11461114.png';
    icon.classList.add('message-icon');

    const label = document.createElement('span');
    label.textContent = sender === 'chatbot' ? 'Chatbot' : 'You';
    label.classList.add('message-label');

    headerContainer.appendChild(icon);
    headerContainer.appendChild(label);

    const text = document.createElement('p');
    text.innerHTML = message;
    text.classList.add('message-text');

    messageContainer.appendChild(headerContainer);
    messageContainer.appendChild(text);
    chatHistory.appendChild(messageContainer);

    scrollToBottom();

    return messageContainer; // Allow for the message container to be manipulated
}

    function displayProductOptions() {
      
      const productSpans = document.createElement('div');
      products.forEach(product => {
          const span = document.createElement('span');
          span.textContent = product.name;
          span.classList.add('product-span');
          span.addEventListener('click', () => {
              currentProduct = product;
              displayProductProperties(product);
          });
          productSpans.appendChild(span);
      });
      chatHistory.appendChild(productSpans);
    }

    function displayProductProperties(product) {
      const propertyButtons = document.createElement('div');
      Object.keys(product).forEach(key => {
          if (key !== 'name' && key !== 'sources') {
              const button = document.createElement('button');
              button.textContent = formatPropertyName(key);
              button.classList.add('product-button');
              button.addEventListener('click', () => {
                  addMessageToChat(`${formatPropertyName(key)}: ${formatPropertyContent(product[key])}`, 'chatbot');
                  clearTimeout(followUpTimeout); // Clear any previously scheduled messages
                  scheduleFollowUpMessage(); // Schedule new follow-up message
              });
              propertyButtons.appendChild(button);
          }
      });
      chatHistory.appendChild(propertyButtons);
    }

    function formatPropertyContent(property) {
  if (typeof property === 'object' && property !== null && !Array.isArray(property)) {
      return Object.keys(property).map((key, index) => {
        let value = property[key];
        // Check if value is a URL
        if (/^https?:\/\//.test(value)) {
          value = `<a href="${value}" target="_blank">${value}</a>`;
        }
        return `${index > 0 ? '<br>' : ''}${formatPropertyName(key)}: ${value}`;
      }).join("");
  } else if (Array.isArray(property)) {
      return property.join(', ');
  } else {
      return property;
  }
}


    function formatPropertyName(name) {
      return name.replace(/([a-z])([A-Z])/g, '$1 $2').replace(/\b(\w)/g, s => s.toUpperCase());
    }

    function scrollToBottom() {
      chatHistory.scrollTop = chatHistory.scrollHeight;
    }
  