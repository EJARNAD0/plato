document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.querySelector('.dropdown');
    const dropdownContent = dropdown.querySelector('.dropdown-content');

    dropdown.addEventListener('click', () => {
        const isVisible = dropdownContent.style.display === 'block';
        dropdownContent.style.display = isVisible ? 'none' : 'block';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdown.contains(event.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});

// JavaScript for sending notification using Ajax (Optional, for better UX)
document.addEventListener('DOMContentLoaded', function () {
    const notificationForm = document.querySelector('.section.notifications form');

    if (notificationForm) {
        notificationForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Gather form data
            const userId = document.querySelector('#user_id').value;
            const message = document.querySelector('#message').value;

            // Perform basic validation
            if (userId === '' || message === '') {
                alert('Please select a user and provide a message.');
                return;
            }

            // Create form data object
            const formData = new FormData();
            formData.append('user_id', userId);
            formData.append('message', message);

            // Send the notification data using Ajax
            fetch('process_notification.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Notify the admin about the status
                alert('Notification sent successfully!');
                // Clear form fields after sending the notification
                document.querySelector('#message').value = '';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending the notification.');
            });
        });
    }
});

// JavaScript for handling real-time notifications (Polling for new notifications every 30 seconds)
function fetchNotifications() {
    fetch('fetch_notifications.php')
        .then(response => response.json())
        .then(data => {
            const notificationList = document.querySelector('.section.user-notifications ul');

            // Clear the notification list
            notificationList.innerHTML = '';

            if (data.length > 0) {
                data.forEach(notification => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `
                        <div>
                            <strong>Message:</strong> ${notification.message} <br>
                            <em>Received on: ${notification.created_at}</em>
                        </div>
                        <a href="mark_as_read.php?id=${notification.notification_id}">Mark as Read</a>
                    `;
                    notificationList.appendChild(listItem);
                });
            } else {
                notificationList.innerHTML = '<li>No new notifications.</li>';
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });
}

// Poll for new notifications every 30 seconds
setInterval(fetchNotifications, 30000);

// Fetch notifications immediately on page load
document.addEventListener('DOMContentLoaded', function () {
    fetchNotifications();
});

document.addEventListener('DOMContentLoaded', function () {
    const feedbackLink = document.getElementById('feedback-link');
    const contentSections = document.querySelectorAll('.content, #subcontent'); // Select content to hide

    // Event listener for feedback link click
    feedbackLink.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default behavior of the link

        // Hide all sections except feedback
        contentSections.forEach(section => {
            section.classList.add('hidden'); // Add hidden class to hide content
        });

        // Show the feedback section only
        document.querySelector('.content').classList.remove('hidden');
    });
});
