from flask import Flask, request, jsonify
import google.generativeai as genai
from flask_cors import CORS

geminiapi: str = 'AIzaSyBLYI8FbaZGoI3pMs1faHhOLZrHUWfh7VA'

genai.configure(api_key=geminiapi)

# Create the model
generation_config = {
  "temperature": 1,
  "top_p": 0.95,
  "top_k": 64,
  "max_output_tokens": 8192,
  "response_mime_type": "application/json",
}

model = genai.GenerativeModel(
  model_name="gemini-1.5-flash",
  generation_config=generation_config,
  # safety_settings = Adjust safety settings
  # See https://ai.google.dev/gemini-api/docs/safety-settings
)

app = Flask(__name__)
CORS(app)

@app.route('/gemini', methods=['POST'])
def gemini():
    prompt = "Genera testo introduttivo e sintetico su \"RETINA\" con un sistema di sottoparagrafi che si diramano in tre domande e che seguono i pattern di frase indicati dopo la domanda, i pattern da sostituire col contenuto sono tra parentesi quadre (LASCIA LE PARENTESI QUADRE QUANDO EFFETTUI LA SOSTITUZIONE, NON CANCELLARLE):Domanda 1: \"cosa è?\", Pattern: [natura essenziale][congiuntivo][caratteristica distintiva 1][congiuntivo][caratteristica distintiva 2]Domanda 2: \"dov'è?\", Pattern: [introduzione][posizione]: [precisazione]Domanda 3: \"cosa significa?\" Pattern: Dal [derivazione etimologica], che [traduzione]: [motivazione]Organizza i paragrafi delle singole domande in formato JSON dove le chiavi sono le domande che ti ho indicato.Il pattern devi seguirlo solo se è tra parentesi quadre, dove non ci sono parentesi quadre lascia il testo così. Rispondimi solo in JSON. Non introdurmi con i tuoi testi introduttivi."

    response = model.generate_content(prompt)

    # Esegui una qualche logica con 'name' e 'value'
    response = {
        "message": response.text,
        "status": "success"
    }
    return jsonify(response), 200

# Avvio dell'app Flask
if __name__ == '__main__':
    app.run(debug=True)