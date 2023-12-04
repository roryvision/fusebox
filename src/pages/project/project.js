$(document).ready(async () => {
  $('.button-apply').on('click', async function() {
    let projectId = $(this).attr('project');
    let roleId = $(this).attr('role');
    openModal();

    // handleApply(projectId, roleId);
  });
});

function openModal() {
  document.getElementById('overlay').style.display = 'block';
  document.getElementById('modal').style.display = 'block';

}

function closeModal() {
  document.getElementById('overlay').style.display = 'none';
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