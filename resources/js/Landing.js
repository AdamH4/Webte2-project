export default class Landing {
    constructor() {
        this.studentTab = document.getElementById("student-tab");
        this.studentIcon = document.getElementById("student-icon");
        this.studentIconHover = document.getElementById("student-icon-hover");
        this.teacherTab = document.getElementById("teacher-tab");
        this.teacherIcon = document.getElementById("teacher-icon");
        this.teacherIconHover = document.getElementById("teacher-icon-hover");

        if (this.studentTab) {
            this.initHideTabImages();
            this.bindEvents();
        }
    }

    initHideTabImages() {
        this.studentIconHover.style.display = "inline-block";
        this.studentIcon.style.display = "none";
        this.teacherIconHover.style.display = "none";
        this.teacherIcon.style.display = "inline-block";
    }

    bindEvents() {
        this.studentTab.addEventListener("click", (e) => {
            // retardovane bootstrap jQuery Tabs musi tam byt delay kym sa nastavi classa active preto setTimeout
            // TODO: spravit taby vanilla JS, uz sa mi nechcelo
            setTimeout(() => {
                if (this.studentTab.classList.contains("active")) {
                    this.studentIconHover.style.display = "inline-block";
                    this.studentIcon.style.display = "none";
                    this.teacherIconHover.style.display = "none";
                    this.teacherIcon.style.display = "inline-block";
                } else {
                    this.studentIconHover.style.display = "none";
                    this.studentIcon.style.display = "inline-block";
                    this.teacherIconHover.style.display = "inline-block";
                    this.teacherIcon.style.display = "none";
                }
            }, 1);
        });

        this.teacherTab.addEventListener("click", (e) => {
            setTimeout(() => {
                if (this.teacherTab.classList.contains("active")) {
                    this.teacherIconHover.style.display = "inline-block";
                    this.teacherIcon.style.display = "none";
                    this.studentIconHover.style.display = "none";
                    this.studentIcon.style.display = "inline-block";
                } else {
                    this.teacherIconHover.style.display = "none";
                    this.teacherIcon.style.display = "inline-block";
                    this.studentIconHover.style.display = "inline-block";
                    this.studentIcon.style.display = "none";
                }
            }, 1);
        });
    }
}
