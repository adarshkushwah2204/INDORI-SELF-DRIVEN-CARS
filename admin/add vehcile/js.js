// add event listener to form submit
document.getElementById('add-vehicle-form').addEventListener('submit', addVehicle);

function addVehicle(e) {
	e.preventDefault();
	// get form data
	var formData = new FormData();
	formData.append('vehicletitle', document.getElementById('vehicletitle').value);
	formData.append('brandname', document.getElementById('brandname').value);
	formData.append('vehicalorcview', document.getElementById('vehicalorcview').value);
	formData.append('priceperday', document.getElementById('priceperday').value);
	formData.append('fueltype', document.getElementById('fueltype').value);
	formData.append('modelyear', document.getElementById('modelyear').value);
	formData.append('seatingcapacity', document.getElementById('seatingcapacity').value);
	// append images
	for (var i = 1; i <= 5; i++) {
		var imgInput = document.getElementById('img' + i);
		if (imgInput.files.length > 0) {
			formData.append('img' + i, imgInput.files[0]);
		}
	}
	// append accessories
	var accessories = [];
	var checkboxes = document.getElementsByName('accessories[]');
	for (var i = 0; i < checkboxes.length; i++) {
		if (checkboxes[i].checked) {
			accessories.push(checkboxes[i].value);
		}
	}
	formData.append('accessories', JSON.stringify(accessories));
	// send form data to server
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'add_vehicle.php');
	xhr.onload = function() {
		if (xhr.status === 200) {
			alert('Vehicle added successfully');
			document.getElementById('add-vehicle-form').reset();
		} else {
			alert('Error adding vehicle');
		}
	};
	xhr.send(formData);
}