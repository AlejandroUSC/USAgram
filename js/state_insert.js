// Display state content
document.addEventListener('DOMContentLoaded', function () {
    const params = new URLSearchParams(window.location.search);
    const stateName = params.get('state');

    const endpoint = `https://en.wikipedia.org/w/api.php`;

    if (stateName)
        document.getElementById('state-name-rep').textContent = stateName.replace(/_/g, " ");

    // Grabs the flag
    if (stateName) {
        const stateURL = encodeURIComponent(stateName.replace(/ /g, "_"));

        fetch(`${endpoint}?action=query&titles=File:Flag_of_${stateURL}.svg&prop=imageinfo&iiprop=url&format=json&origin=*`)
            .then(response => response.json())
            .then(data => {
                const pages = data.query.pages;
                const page = pages[Object.keys(pages)[0]];
                if (page.imageinfo) {
                    const imageUrl = page.imageinfo[0].url;
                    document.getElementById('state-flag').src = imageUrl;
                } else {
                    console.log(`Flag couldn't be found - ${stateName}.`);
                }
            })
            .catch(error => console.error('Error fetching:', error));
    } else {
        console.log('State param isnt in URL.');
    }

    // Grabs desc from Wiki
    if (stateName) {
        const stateURL = encodeURIComponent(stateName.replace(/ /g, "_"));
        fetch(`${endpoint}?action=query&format=json&origin=*&prop=extracts&exintro&explaintext&redirects=1&titles=${stateURL}`)
            .then(response => response.json())
            .then(data => {
                const pages = data.query.pages;
                const page = pages[Object.keys(pages)[0]];
                if (page.extract) {
                    const words = page.extract.split(/\s+/);
                    const first200Words = words.slice(0, 200).join(' ');
                    document.getElementById('state-desc').firstElementChild.textContent = first200Words + '...';
                } else {
                    console.log('Description not found');
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    } else {
        console.log('State param isnt URL.');
    }
});

// Check if user is logged in or not - display modal accordingly
document.getElementById('upload-button').addEventListener('click', function () {
    const button = this;
    const isLoggedIn = checkUserLoggedIn(); // Needs

    if (!isLoggedIn) {
        button.setAttribute('data-target', '#loginRegisterModal');
        document.getElementsByName('data-target').textContent = ""
        $('#loginRegisterModal').modal('show');
    } else {
        button.setAttribute('data-target', '#uploadModal');
        $('#uploadModal').modal('show');
    }
});

// To Be Implemented during Backend
function checkUserLoggedIn() {
    return true; 
}

// // Handle with backend
// document.querySelector('#upload-form').onsubmit = () => {
//     const imageInput = document.querySelector('#picture-upload');
//     let file = imageInput.files[0];

//     const descriptionInput = document.querySelector('#description');
//     let descriptionText = descriptionInput.value;

//     const locationInput = document.querySelector('#location');
//     let locInput = locationInput.value;

//     const timeInput = document.querySelector('#time');
//     let tInput = timeInput.value;

//     if (file && descriptionText && locInput && tInput) {
//         const userImg = document.querySelector('#picture-upload');
//         const userDesc = document.querySelector('#description');
//         const descText = userDesc.value;

//         const postContainer = document.createElement('div');
//         const postHeader = document.createElement('div');
//         const spanUser = document.createElement('span');
//         const spanState = document.createElement('span');
//         const spanDate = document.createElement('span');
//         const spanRemove = document.createElement('span');
//         const postBody = document.createElement('div');
//         const userImage = document.createElement('img');
//         const postDescription = document.createElement('div');
//         const user_desc = document.createElement('p');

//         userImage.src = URL.createObjectURL(userImg.files[0]);
//         // userImage.src = 'usr_img/Mountrushmore.jpeg';
//         userImage.alt = 'Uploaded Image';
//         user_desc.textContent = descText;
//         spanUser.textContent = "Will grab from backend";
//         spanDate.textContent = "Date:" + tInput;

//         const params = new URLSearchParams(window.location.search);
//         const stateName = params.get('state');
//         spanState.textContent = "Location: " + locInput + ' ' + stateName;

//         postContainer.classList.add('post-container');
//         postHeader.classList.add('post-header');
//         postBody.classList.add('post-body');
//         userImage.classList.add('user-image');
//         postDescription.classList.add('post-description');
//         user_desc.classList.add('user-description');
//         spanUser.classList.add('user-name');
//         spanState.classList.add('state-name');
//         spanDate.classList.add('post-date');
//         spanRemove.classList.add('todo-remove', 'oi', 'oi-circle-x');
//         spanRemove.title = 'Remove';

//         postHeader.appendChild(spanUser);
//         postHeader.appendChild(spanState);
//         postHeader.appendChild(spanDate);
//         postHeader.appendChild(spanRemove);
//         postDescription.appendChild(user_desc);
//         postBody.appendChild(userImage);
//         postBody.appendChild(postDescription);
//         postContainer.appendChild(postHeader);
//         postContainer.appendChild(postBody);

//         document.querySelector('#content').appendChild(postContainer);

//         document.querySelector('#picture-upload').value = '';
//         document.querySelector('#description').value = '';
//         document.querySelector('#location').value = '';
//         document.querySelector('#time').value = '';
//         bindRemoveBtns();

//         $('#uploadModal').modal('hide');
//     }
//     return false;
// };


// Remove User Content
// To be finished when doing backend
function bindRemoveBtns() {
    const buttons = document.querySelectorAll(".todo-remove")

    for (btn of buttons) {
        btn.onclick = function () {
            this.parentElement.parentElement.remove()
        }
    }
}

bindRemoveBtns()
