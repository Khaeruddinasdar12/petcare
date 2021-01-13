// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.2/firebase-messaging.js');

// importScripts('https://www.gstatic.com/firebasejs/8.2.2/firebase-auth.js');
// importScripts('https://www.gstatic.com/firebasejs/8.2.2/firebase-firestore.js');
// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
var firebaseConfig = {
  apiKey: "AIzaSyAXMFabSnctaDDAABRSuxPKxIhiTW22qNI",
  authDomain: "petcare-8fdde.firebaseapp.com",
  projectId: "petcare-8fdde",
  storageBucket: "petcare-8fdde.appspot.com",
  messagingSenderId: "189745989695",
  appId: "1:189745989695:web:d6841b38fbcd6e8f33508a",
  measurementId: "G-FBG1DW8XD1"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

// firebase.initializeApp(firebaseConfig);
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});

