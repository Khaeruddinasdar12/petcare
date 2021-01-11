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
	apiKey: "AIzaSyAlMslEpJ8rSkaA8648H0ySkis-668E-P0",
	authDomain: "chat-b1584.firebaseapp.com",
	databaseURL: "https://chat-b1584.firebaseio.com",
	projectId: "chat-b1584",
	storageBucket: "chat-b1584.appspot.com",
	messagingSenderId: "375668871045",
	appId: "1:375668871045:web:f0e8da12520d4d8e84beec",
	measurementId: "G-5GDV77GLYH"
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
  const { title, body} = payload.notification;
  const notificationTitle = 'Ada pesan';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});