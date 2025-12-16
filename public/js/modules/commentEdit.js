import { commentState } from "../state/comment.js";


const comEdContainer = document.getElementById('comment-edit-section');
const uploadEditedCommBtn = document.getElementById('update-comment');
const closeEComment = document.querySelector('.close-edit-comment');

export function renderEdit() {
    console.log('Comment ID received from state: '+commentState.commentId);
    console.log('Content: '+commentState.commentContent);
    console.log('Hello');

    comEdContainer.classList.remove(
        'translate-y-full',
        'pointer-events-none'
    );
    comEdContainer.classList.add(
        'translate-y-0',
        'pointer-events-auto'
    );
    commentField.classList.add('hidden');
    setTimeout(() => {
        writeCommentContainer.classList.add('hidden');
    },300);
}


    
