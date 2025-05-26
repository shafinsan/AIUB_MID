const nameRegex = /^[a-zA-Z\s]+$/;
const emailRegex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;

document.querySelector(".custom-form").addEventListener("submit", (e) => {
    e.preventDefault();
    let hasError = false;
    document.querySelectorAll(".error").forEach((span) => {
        span.textContent = "";
    });
    const formData = new FormData(e.target);
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    const trimmedName = data.fullname ? data.fullname.trim() : "";
    if (!trimmedName) {
        document.querySelector("#fullname + .error").textContent =
            "Name is required😊";
        hasError = true;
    } else if (!nameRegex.test(trimmedName)) {
        document.querySelector("#fullname + .error").textContent =
            "Full Name must contain only a-Z😀";
        hasError = true;
    } else if (trimmedName.includes("  ")) {
        document.querySelector("#fullname + .error").textContent =
            "Full Name cannot contain multiple spaces😣";
        hasError = true;

    }

    if (!data.email) {
        document.querySelector("#email + .error").textContent = "Email is required😓";
        hasError = true;

    } else if (!emailRegex.test(data.email)) {
        document.querySelector("#email + .error").textContent =
            "Please enter a valid email😑";
        hasError = true;

    }

    if (!data.password) {
        document.querySelector("#password + .error").textContent =
            "Password is required😴";
        hasError = true;

    }

    if (!data.confirmPassword) {
        document.querySelector("#confirmPassword + .error").textContent =
            "Confirm Password is required😴";
        hasError = true;

    } else if (data.password !== data.confirmPassword) {
        document.querySelector("#confirmPassword + .error").textContent =
            "Passwords do not match🙄";
        hasError = true;

    }


    if (!data.dob) {
        document.querySelector("#dob + .error").textContent =
            "Date of Birth is required🤐";
        hasError = true;

    } else {
        const birthDate = new Date(data.dob);
        const currentDate = new Date();
        let age = currentDate.getFullYear() - birthDate.getFullYear();
        const monthDifference = currentDate.getMonth() - birthDate.getMonth();
        if (
            monthDifference < 0 ||
            (monthDifference === 0 && currentDate.getDate() < birthDate.getDate())
        ) {
            age--;
        }
        if (age < 18) {
            document.querySelector("#dob + .error").textContent =
                "You must be at least 18 years old😶";
            hasError = true;

        }
    }
    if (!data.gender) {
        document.querySelector("#gender + .error").textContent =
            "Gender is required😳";
        hasError = true;

    }
    if (!hasError) {
        e.target.submit(); // submit the form
    }

});

//this part is for cursor
document.addEventListener("mousemove", (e) => {
    let x = e.clientX;
    let y = e.clientY;
    document.querySelector(".cursor1").style.cssText = `left:${x}px;top:${y}px;`;
    document.querySelector(".cursor2").style.cssText = `left:${x}px;top:${y}px;`;
});

