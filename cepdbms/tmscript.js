const socialIconButtons = document.getElementsByClassName("social-icon");

function postToSocialMedia(classList) {
    const content = "Check out my cool generative AI Project 😎 \n${window.location.href.toString()}";
    if (classList.contains("twitter")) {
        const url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(
      content
    )}`;
        window.open(url);
    } else if (classList.contains("linkedin")) {
        const url = `https://www.linkedin.com/share?text=${encodeURIComponent(
      content
    )}`;
        window.open(url);
    } else if (classList.contains("whatsapp")) {
        window.open("https://api.whatsapp.com/send?text=${encodeURIComponent(content)}");
    }
}

const addEventListenersToSocialIconButton = () => {
    for (let i = 0; i < socialIconButtons.length; i++) {
        socialIconButtons[i].addEventListener("click", () =>
            postToSocialMedia(socialIconButtons[i].classList)
        );
    }
};

addEventListenersToSocialIconButton();

const skillIcon = document.getElementsByClassName("tooltip");


const addEventListenersToSkillIcon = () => {
    for (let i = 0; i < skillIcon.length; i++) {
        skillIcon[i].addEventListener("click", (e) => {
            console.log(e.target)
            updateDescription(e.target.id);
        });
    }
};

addEventListenersToSkillIcon();

const descriptionDiv = document.getElementsByClassName("about-section");
const updateDescription = (id) => {
    let description = "";

    switch (id) {
        case "googleColab":
            description = "Google Colab: User-friendly platform for code writing, execution, and sharing. Beloved by AI experts, students, developers, and researchers for data analysis, ML, and AI exploration.";
            break;
        case "gradio":
            description = "Gradio: A user-friendly tool that allows to create and share interactive Al Apps without extensive Coding Knowledge.";
            break;
        case "openAi":
            description = "OpenAI: An AI-based chat service powered by Open AI's language model. OpenAI APIs offer access to advanced language models and AI capabilities. Integrate NLP, text generation, and more into your apps to revolutionize communication and problem-solving. ";
            break;
        case "playHt":
            description = "PlayHT: PlayHT is a platform that allows you to clone voices using artificial intelligence. The platform uses a deep learning model to train a voice clone that sounds almost exactly like the original voice.";
            break;
        case "huggingFace":
            description = "HuggingFace: The ultimate destination for building, training, and deploying cutting-edge machine learning models! Revolutionize your AI projects with state-of-the-art NLP and more!";
            break;
        case "langChain":
            description = "LangChain: Seamlessly combine Large Language Models (LLMs) with external computation/data. Build chatbots, analyze data effortlessly. Open source for contributions.";
            break;
        default:
            description = "Description of the selected icon will appear here.";
    }
    for (let i = 0; i < descriptionDiv.length; i++) {
        descriptionDiv[i].textContent = description;
    }
};

updateDescription("googleColab");


let question = document.getElementById("input_question");
let answer = document.getElementById("answer_element");
answer.textContent = "";
let error = document.getElementById("error_message");


const data = [{
        question: "What is the capital of France?",
        answer: "Paris"
    },
    {
        question: "What is the chemical symbol for water?",
        answer: "H2O"
    },
    {
        question: "What year did the Titanic sink?",
        answer: "1912"
    },
    {
        question: "Doctor of heart?",
        answer: "Cardiologist"
    },
    {
        question: "Hii",
        answer: "Hey there how can i assist you today?"
    },
    {
        question: "How are you?",
        answer: "I am fine glad that you have asked me!!"
    },
    {
        question: "Doctor of Lungs?",
        answer: "Pulmonologist"
    },
    {
        question: "Doctor of Kidney?",
        answer: "Nephrologist"
    },
    {
        question: "What is cancer?",
        answer: "Cancer is a general term for a group of diseases that cause cells to grow and divide abnormally, sometimes beyond their normal boundaries. This can lead to the creation of tumors, which can then invade nearby tissues and spread to other parts of the body through the blood and lymph systems"
    },
    {
        question: "Doctor of brain?",
        answer: "Neurologist"
    },
    {
        question: "Doctor of stomach?",
        answer: "Gastroenterologist"
    },
    {
        question: "Doctor of bones?",
        answer: "Orthopedician"
    }
];


document.addEventListener('DOMContentLoaded', function() {
    speechSynthesis.onvoiceschanged = () => {
        voices = speechSynthesis.getVoices();
    };
});

function speakText(text) {
    if ('speechSynthesis' in window && voices.length > 0) {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.voice = voices.find(voice => voice.lang.startsWith('en')) || voices[0];
        utterance.volume = 1; // From 0 to 1
        utterance.rate = 1; // From 0.1 to 10
        utterance.pitch = 1; // From 0 to 2
        speechSynthesis.speak(utterance);
    } else {
        console.error('Your browser does not support speech synthesis, or no voices loaded.');
    }
}


function findAnswer(query) {
    query = query.trim().toLowerCase();
    const answerElement = document.getElementById('answer_element');
    for (const item of data) {
        const questionLower = item.question.toLowerCase();
        if (questionLower === query || questionLower.includes(query)) {
            answerElement.textContent = item.answer;
            answer.classList.add("cbit_answer");
            question.value = "";
            speakText(item.answer);
            return;
        }
    }
    answerElement.textContent = "Question not found";
    speakText("Question not found");
    answer.textContent = "Question not found";
    answer.classList.add("cbit_answer");
    question.value = "";
    return;
}

function submitQuestion() {
    const questionInput = document.getElementById('input_question');
    const errorElement = document.getElementById('error_message');
    if (questionInput.value.trim() === "") {
        errorElement.textContent = "Please enter a valid question.";
        return;
    }
    errorElement.textContent = "";
    findAnswer(questionInput.value);
}

function generatevoicemessage() {
    speakText("You have been using the phone from a very long time here i have prepared some intresting games for you common lets do it together");
}




let searchInputEl = document.getElementById("searchInput");

let searchResultsEl = document.getElementById("searchResults");

let spinnerEl = document.getElementById("spinner");

function createAndAppendSearchResult(result) {
    let {
        link,
        title,
        description
    } = result;

    let resultItemEl = document.createElement("div");
    resultItemEl.classList.add("result-item");

    let titleEl = document.createElement("a");
    titleEl.href = link;
    titleEl.target = "_blank";
    titleEl.textContent = title;
    titleEl.classList.add("result-title");
    resultItemEl.appendChild(titleEl);

    let titleBreakEl = document.createElement("br");
    resultItemEl.appendChild(titleBreakEl);

    let urlEl = document.createElement("a");
    urlEl.classList.add("result-url");
    urlEl.href = link;
    urlEl.target = "_blank";
    urlEl.textContent = link;
    resultItemEl.appendChild(urlEl);

    let linkBreakEl = document.createElement("br");
    resultItemEl.appendChild(linkBreakEl);

    let descriptionEl = document.createElement("p");
    descriptionEl.classList.add("link-description");
    descriptionEl.textContent = description;
    resultItemEl.appendChild(descriptionEl);

    searchResultsEl.appendChild(resultItemEl);
}

function displayResults(searchResults) {
    spinnerEl.classList.add("d-none");

    for (let result of searchResults) {
        createAndAppendSearchResult(result);
    }
}

function searchWikipedia(event) {
    if (event.key === "Enter") {

        spinnerEl.classList.remove("d-none");
        searchResultsEl.textContent = "";

        let searchInput = searchInputEl.value;
        let url = "https://apis.ccbp.in/wiki-search?search=" + searchInput;
        let options = {
            method: "GET"
        };

        fetch(url, options)
            .then(function(response) {
                return response.json();
            })
            .then(function(jsonData) {
                let {
                    search_results
                } = jsonData;
                displayResults(search_results);
            });
    }
}

searchInputEl.addEventListener("keydown", searchWikipedia);