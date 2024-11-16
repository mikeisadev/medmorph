import http from "../../../http";
import '../../../scss/maintenance.scss';
import { newsletterLeadEP } from "../../../config";
import { createRoot } from "react-dom/client";
import Loader from "../../components/Loader";

const maintenanceContainer = document.querySelector('#maintenance-container');
const newsletterForm = maintenanceContainer.querySelector('#newsletter-form');
const submitButton = newsletterForm.querySelector('button[type="submit"]');
const loaderRootEl = maintenanceContainer.querySelector('#loader-root');

newsletterForm.addEventListener('submit', (e) => {  
  e.preventDefault();

  submitButton.setAttribute('disabled', 'disabled');

  const formData = new FormData(newsletterForm as HTMLFormElement);

  newsletterForm.querySelectorAll('.val').forEach((val) => {
    val.remove();
  });

  const loaderRoot = createRoot(loaderRootEl);
  loaderRoot.render(<Loader props={{loaderText: 'Invio in corso...'}}/>);

  setTimeout(
    () => {
      http.post(newsletterLeadEP, formData)
        .then(response => {
          const data = response.data;

          loaderRoot.unmount();
    
          console.log(data);
          console.log('Form submitted');
    
          if (data.status === 'success') {
            newsletterForm.classList.add('hide');
    
            const successMessage = document.createElement('div');
            successMessage.classList.add('success-message');
            successMessage.innerHTML = '<p class="val success">Grazie per esssere entrato a far parte della nostra community!</p>';
            newsletterForm.parentElement.appendChild(successMessage);
          }

          submitButton.removeAttribute('disabled');
        })
        .catch(error => {
          submitButton.removeAttribute('disabled');

          loaderRoot.unmount();

          console.error(error.response.data);

          const errorFields: object|null = error.response.data;

          console.log(typeof errorFields);

          if (errorFields && typeof errorFields === 'object') {
            Object.keys(errorFields).forEach((field_id) => {
              const field = newsletterForm.querySelector(`#${field_id}`);
              const errorField = errorFields[field_id];

              field.classList.add('error');
              field.parentElement.insertAdjacentHTML('beforeend', `<p class="val error">${errorField}</p>`);
            });
          } else {
            const errorMessage = document.createElement('div');
            const errorResponse = error.response.data;

            errorMessage.classList.add('error-message');

            if (typeof errorResponse === 'string') {
              errorMessage.innerHTML = `<p class="val error">${errorResponse}</p>`;
            } else {
              errorMessage.innerHTML = '<p class="val error">Errore durante l\'invio del form. Riprova più tardi.</p>';
            }

            newsletterForm.parentElement.appendChild(errorMessage);
          }
    
      });
    }, 1000
  );
}); 