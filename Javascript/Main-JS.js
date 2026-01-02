function showForm(form) {
  const loginTab = document.getElementById('loginTab');
  const registerTab = document.getElementById('registerTab');
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  
  if (form === 'login') {
    loginTab.classList.add('active');
    registerTab.classList.remove('active');
    loginForm.classList.add('active');
    registerForm.classList.remove('active');
  } else {
    registerTab.classList.add('active');
    loginTab.classList.remove('active');
    registerForm.classList.add('active');
    loginForm.classList.remove('active');
  }
}

function showAdminLogin() {
  const adminLoginDiv = document.getElementById("adminLoginDiv");
  adminLoginDiv.classList.remove("hidden");
}

function registerUser() {
const email = document.getElementById('registerEmail').value;
const password = document.getElementById('registerPassword').value;

// Here you can send an AJAX request to your register PHP script
}

const services = {
  "Remote Start": "Remote start technology allows you to start your vehicle from the comfort of your home or office with just a push of a button on your key fob or smartphone app. This feature is particularly beneficial during cold winter mornings or hot summer afternoons, enabling your car’s climate control system to warm up or cool down the interior before you even step inside. Enjoy the convenience of pre-conditioning your vehicle, ensuring it’s always at a comfortable temperature when you are ready to drive. Additionally, remote start enhances your vehicle's security by allowing you to start the engine without being inside the car, reducing the risk of theft. Experience the luxury and comfort of remote starting your vehicle, making every journey enjoyable.",
  "Keyless Entry": "With keyless entry systems, accessing your vehicle has never been easier. This advanced technology allows you to unlock and start your car without removing the keys from your pocket or bag. Simply approach your car, and it will automatically unlock as you get closer, providing a seamless and convenient experience. Keyless entry not only saves you time but also enhances security by using encrypted signals that are difficult for thieves to replicate. Plus, many keyless systems come equipped with additional features like remote locking and unlocking, adding another layer of convenience and safety to your daily routine..",
  "GPS Tracking": "GPS tracking systems provide real-time location data for your vehicle, enhancing your ability to keep tabs on its whereabouts. Whether you are a parent wanting to monitor your teenager's driving habits or a business owner managing a fleet, GPS tracking offers peace of mind and improved safety. The system can alert you if your vehicle is moved without authorization or if it leaves a predetermined area. Additionally, many GPS trackers come with route history and driving behavior reports, helping you optimize routes and save on fuel costs. With GPS tracking, you can ensure your vehicle's safety and stay informed about its location at all times.",
  "Engine Diagnostics": "Engine diagnostics systems are designed to monitor your vehicle's performance and detect any potential issues before they escalate into costly repairs. By using advanced sensors, these systems provide real-time data on engine health, including diagnostics of critical components such as the fuel system, ignition, and exhaust. Regular diagnostics can help identify problems like misfires, fuel inefficiency, or emissions issues, allowing for timely maintenance and repairs. With this information at your fingertips, you can ensure your vehicle operates smoothly and efficiently, prolonging its lifespan and enhancing its performance. Stay proactive about your car’s health with regular engine diagnostics.",
  "Automated Parking": "Automated parking technology takes the stress out of finding and maneuvering into a parking spot. Utilizing advanced sensors and cameras, this system can park your car for you, requiring only that you exit the vehicle and press a button. The technology is designed to navigate tight spaces and parallel park with precision, significantly reducing the risk of scratches and dents. Additionally, automated parking systems often come with features that can guide you back to your vehicle when you're ready to leave. Experience a new level of convenience and confidence in parking with automated systems designed to make urban driving easier and safer.",
  "Safety Alerts": "Safety alerts are crucial for modern vehicles, helping drivers stay informed about potential issues that could affect their safety on the road. These systems monitor various parameters of your vehicle, such as tire pressure, engine performance, and fluid levels, alerting you to any anomalies that require immediate attention. With features like collision warnings, lane departure alerts, and blind-spot monitoring, safety alerts enhance your awareness and help prevent accidents. By receiving real-time notifications, drivers can make informed decisions to maintain their vehicle's health and safety. Invest in safety alert technology to ensure a secure driving experience for you and your passengers."
};

// Get modal elements
const modal = document.getElementById("serviceModal");
const modalTitle = document.getElementById("modalTitle");
const modalDescription = document.getElementById("modalDescription");
const closeButton = document.querySelector(".close-button");

// Function to open the modal
function openModal(serviceName) {
  modalTitle.innerText = serviceName;
  modalDescription.innerText = services[serviceName];
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

// Add event listener to close the modal when clicking the close button
closeButton.addEventListener("click", closeModal);

// Add event listener to close the modal when clicking outside of the modal
window.addEventListener("click", function(event) {
  if (event.target === modal) {
      closeModal();
  }
});

// Add event listeners to each "Learn More" button
const learnMoreButtons = document.querySelectorAll(".service-button");
learnMoreButtons.forEach(button => {
  button.addEventListener("click", function() {
      const serviceName = this.parentElement.querySelector(".service-title").innerText; // Get the service title
      openModal(serviceName);
  });
});