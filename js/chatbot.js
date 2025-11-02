document.addEventListener("DOMContentLoaded", () => {
  const chatBox = document.getElementById("chatBox");
  const userInput = document.getElementById("userInput");
  const sendButton = document.getElementById("sendButton");
  const chatbotContainer = document.getElementById("chatbot-container");
  const chatbotButton = document.getElementById("chatbotButton");
  const closeChatbot = document.getElementById("closeChatbot");

  const bakeryBotResponses = {
    hello: "Hi there! Welcome to our bakery. How can I assist you?",
    menu: "We offer a variety of cakes, pastries, bread, and cookies! What would you like?",
    cakes: "We have chocolate, vanilla, and red velvet cakes. Which one would you like?",
    cake: "We have chocolate, vanilla, and red velvet cakes. Which one would you like?",
    bread: "We have sourdough, whole grain, and white bread. What do you prefer?",
    breads: "We have sourdough, whole grain, and white bread. What do you prefer?",
    chocolate: "Very nice choice",
    vanilla: "Very nice choice",
    redvelvet: "Very nice choice",
    sourdough:"Very nice choice",
    Wholegrain:"Very nice choice",
    WhiteBread:"Very nice Choce",
    thanks: "You're welcome! Have a sweet day!",
    hi: "Hi there! Welcome to our bakery. How can I help you?",
    default: "I'm sorry, I didn't understand that. Could you please rephrase?",
  };

  const appendMessage = (text, sender) => {
    const message = document.createElement("div");
    message.classList.add("message", sender);
    message.textContent = text;
    chatBox.appendChild(message);
    chatBox.scrollTop = chatBox.scrollHeight;
  };

  const handleUserMessage = () => {
    const userMessage = userInput.value.trim().toLowerCase();
    if (!userMessage) return;

    appendMessage(userInput.value, "user");
    userInput.value = "";

    const botResponse = bakeryBotResponses[userMessage] || bakeryBotResponses.default;
    setTimeout(() => appendMessage(botResponse, "bot"), 500);
  };

  // Event listeners for sending messages
  sendButton.addEventListener("click", handleUserMessage);
  userInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      handleUserMessage();
    }
  });

  // Show the chatbot container
  chatbotButton.addEventListener("click", () => {
    chatbotContainer.classList.remove("chat-hidden");
    chatbotContainer.style.display = "block";
  });

  // Hide the chatbot container
  closeChatbot.addEventListener("click", () => {
    chatbotContainer.classList.add("chat-hidden");
    chatbotContainer.style.display = "none";
  });
});


