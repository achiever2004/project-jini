from transformers import pipeline
import sys
import json

def analyze_command(command):
    nlp = pipeline("sentiment-analysis")
    result = nlp(command)
    return result[0]

if __name__ == "__main__":
    command = sys.argv[1]
    analysis_result = analyze_command(command)
    print(json.dumps(analysis_result))
