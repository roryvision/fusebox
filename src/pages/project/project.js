let roleName = "";
let projectId = -1;
let roleId = -1;
import confetti from 'https://cdn.skypack.dev/canvas-confetti';

$(document).ready(async () => {
  $('.button-apply').on('click', async function() {
    projectId = $(this).attr('project');
    roleName = $(this).attr('value');
    roleId = $(this).attr('role');
    openModal();
  });

  $('#add-note').on('click', async function() {
    document.getElementById('prompt').style.display = 'none';
    document.getElementById('form').style.display = 'block';
    document.getElementById('note-buttons').style.display = 'none';
    document.getElementById('form-buttons').style.display = 'flex';
  });
  $('#no-note').on('click', async function() {
    document.getElementById('prompt').style.display = 'none';
    document.getElementById('modal-text').style.display = 'none';
    document.getElementById('note-buttons').style.display = 'none';
    document.getElementById('congrats').style.display = 'block';
    makeConfetti();

    // handleApply(projectId, roleId);
    console.log("you applied yaya");
  });
  $('#send').on('click', async function() {
    document.getElementById('prompt').style.display = 'none';
    document.getElementById('modal-text').style.display = 'none';
    document.getElementById('note-buttons').style.display = 'none';
    document.getElementById('form-buttons').style.display = 'none';
    document.getElementById('form').style.display = 'none';
    document.getElementById('congrats').style.display = 'block';
    makeConfetti();

    // handleApply(projectId, roleId);
    console.log("you applied yaya");
  });


  $('#cancel').on('click', async function() {
    document.getElementById('prompt').style.display = 'block';
    document.getElementById('form').style.display = 'none';
    document.getElementById('note-buttons').style.display = 'flex';
    document.getElementById('form-buttons').style.display = 'none';
  });


  // close modal
  $('#modal-icon').on('click', async function() {
    closeModal();
  });
});

function openModal() {
  document.getElementById('congrats').style.display = 'none';
  document.getElementById('form-buttons').style.display = 'none';
  document.getElementById('form').style.display = 'none';
  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal-1').style.display = 'block';
  document.getElementById('modal-text').style.display = 'block';
  document.getElementById('prompt').style.display = 'block';
  document.getElementById('note-buttons').style.display = 'flex';
  document.querySelector('#modal-text').innerHTML =
      'You are applying to the <strong><span id="red-role">' + roleName + ' Role</span></strong> for <strong>' + projectName + '</strong>.';
}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('modal-1').style.display = 'none';
}

function makeConfetti(){
  confetti()
}

const handleApply = async (projectId, roleId) => {
  try {
    const response = await fetch('../../api/projects/apply.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ 
        project_id: projectId, 
        role_id: roleId 
      }),
    })

    if(!response.ok) {
      console.error('Failed to apply to project');
    }
  } catch (error) {
    console.error(error);
  }
}