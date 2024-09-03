from openai import OpenAI

chatgpt_sk: str = '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'
client = OpenAI(api_key=chatgpt_sk)

completion = client.chat.completions.create(
    model="gpt-4o-mini",
    messages=[
        {
            "role": "user", 
            "content": "Parlarmi di Kant in breve"
        }
    ]
)

print(
    completion
)