// Input Post Tag
const post_tag = document.getElementById("post_tag");
const ulTag = document.querySelector(".tag-box ul");
const inputTag = document.querySelector(".tag-box ul input");
let countNumb = document.querySelector(".tag-wrapper .details span");

let tags = [];
let maxTags = 10;
if (ulTag !== null) {
    ulTag.querySelectorAll("li").forEach((li) => {
        const tagText = li.textContent.trim();
        tags.push(tagText);
    });
}

function countTag() {
    countNumb.innerHTML = maxTags - tags.length;
}

function createTag() {
    ulTag.querySelectorAll("li").forEach((li) => li.remove());
    tags.slice()
        .reverse()
        .forEach((tag) => {
            let liTag = `<li>${tag} <i class='bx bx-x' onclick="removeTag(this, '${tag}')"></i></li>`;
            ulTag.insertAdjacentHTML("afterbegin", liTag);
        });
    post_tag.value = tags;
    countTag();
}

function removeTag(element, tag) {
    let index = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();

    let tagValue = tag;
    let postTagArray = post_tag.value.split(",");
    let postTagValue = postTagArray.indexOf(tagValue);
    if (postTagValue !== -1) {
        postTagArray.splice(postTagValue, 1);
    }
    let updatedValue = postTagArray.join(",");
    post_tag.value = updatedValue;

    countTag();
}

function addTag(e) {
    if (e.key === ",") {
        let tag = e.target.value.replace(/,/g, "").replace(/\s+/g, " ");
        if (tag.length > 1 && !tags.includes(tag)) {
            if (tags.length < 10) {
                tag.split(",").forEach((tag) => {
                    tags.push(tag);
                    createTag();
                });
            }
        }
        e.target.value = "";
    }
}

if (inputTag !== null) {
    inputTag.addEventListener("keyup", addTag);
}

const removeTagBtn = document.querySelector(".tag-wrapper .details button");
if (removeTagBtn !== null) {
    removeTagBtn.addEventListener("click", () => {
        tags.length = 0;
        ulTag.querySelectorAll("li").forEach((li) => li.remove());
        post_tag.value = "";
    });
}

function title() {
    const title = document.querySelector(".title");
    const headTitle = document.querySelector(".head-title");

    if (headTitle != null) {
        const titleText = title.innerHTML;
        headTitle.innerHTML = titleText;
    }
}
title();

function slug() {
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    if (slug != null) {
        title.addEventListener("change", function () {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    }
}
slug();

function flashMassege() {
    const alert = document.querySelector(".alert");
    const alertClose = document.querySelector(".alert-close");
    setTimeout(() => {
        alert.style.animation =
            "alertOut .5s forwards cubic-bezier(0.68, -0.55, 0.265, 1.55)";
        setTimeout(() => {
            alert.style.display = "none";
        }, 1000);
    }, 5000);

    if (alertClose && alert != null) {
        alertClose.addEventListener("click", function () {
            alert.style.animation =
                "alertOut .5s forwards cubic-bezier(0.68, -0.55, 0.265, 1.55)";
            setTimeout(() => {
                alert.style.display = "none";
            }, 1000);
        });
    }
}
flashMassege();

function userProfile() {
    const userInfo = document.querySelector(".user-info");
    const option = document.querySelector(".option");

    if (option != null) {
        option.addEventListener("click", () =>
            userInfo.classList.toggle("active")
        );

        document.addEventListener("click", function (e) {
            if (!option.contains(e.target)) {
                userInfo.classList.remove("active");
            }
        });
    }
}
userProfile();

function slider() {
    const slider1 = document.querySelector(".slider-1");
    const slider2 = document.querySelector(".slider-2");
    const slider3 = document.querySelector(".slider-3");
    const recWrapper = document.querySelector(".rec-wrapper");
    const recContent = document.querySelectorAll(".rec");
    recContent.forEach((rec) => {
        slider1.addEventListener("click", function () {
            rec.style.right = "0px";
            slider1.classList.add("active");
            slider2.classList.remove("active");
            slider3.classList.remove("active");
        });
        slider2.addEventListener("click", function () {
            rec.style.right = "255px";
            slider2.classList.add("active");
            slider1.classList.remove("active");
            slider3.classList.remove("active");
        });
        slider3.addEventListener("click", function () {
            rec.style.right = "510px";
            slider3.classList.add("active");
            slider1.classList.remove("active");
            slider2.classList.remove("active");
        });
    });
}
slider();

function showPass() {
    const passwordInput = document.getElementById("password");
    const showPassbtn = document.getElementById("showPassword");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPassbtn.classList.remove("bxs-hide");
        showPassbtn.classList.add("bxs-show");
        showPassbtn.style.color = "#008cff";
    } else {
        passwordInput.type = "password";
        showPassbtn.classList.remove("bxs-show");
        showPassbtn.classList.add("bxs-hide");
        showPassbtn.style.color = "#2e2e2e";
    }
}

function previewImage() {
    const imgPreview = document.querySelector(".img-preview");
    const image = document.querySelector("#image");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFReader) {
        imgPreview.src = oFReader.target.result;
    };
}
