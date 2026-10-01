"""Create the original 15-second electronic soundtrack for the NexusVora Story.

Standard-library only. Run from the repository root, then mux the WAV into the
1080x1920 video with ffmpeg. The generated WAV is a temporary build artifact.
"""

from array import array
import math
import random
import struct
import sys
import wave


RATE = 32000
DURATION = 15.0
N = int(RATE * DURATION)
BEAT = DURATION / 32
audio = array("f", [0.0]) * N
rng = random.Random(42)


def mix(start, duration, sample):
    first = max(0, int(start * RATE))
    last = min(N, int((start + duration) * RATE))
    for i in range(first, last):
        audio[i] += sample((i / RATE) - start)


def tone(freq, start, duration, volume, decay=2.5):
    def sample(t):
        envelope = min(1.0, t * 80) * math.exp(-decay * t)
        shimmer = math.sin(2 * math.pi * freq * t)
        shimmer += 0.24 * math.sin(2 * math.pi * freq * 2 * t)
        return volume * envelope * shimmer

    mix(start, duration, sample)


# Evolving pads: C minor, A-flat, E-flat, B-flat.
chords = [
    (130.81, 155.56, 196.00),
    (103.83, 155.56, 207.65),
    (155.56, 196.00, 233.08),
    (116.54, 174.61, 233.08),
]
for bar, chord in enumerate(chords):
    start = bar * 3.75
    for note in chord:
        def pad(t, f=note):
            env = min(1.0, t / 0.55) * min(1.0, (3.9 - t) / 0.75)
            breath = 0.86 + 0.14 * math.sin(2 * math.pi * 0.6 * t)
            return 0.022 * max(0.0, env) * breath * (
                math.sin(2 * math.pi * f * t)
                + 0.23 * math.sin(2 * math.pi * f * 2.004 * t)
            )

        mix(start, 3.9, pad)


# A clear plucked motif follows the scene changes.
motif = [261.63, 392.00, 466.16, 392.00, 311.13, 466.16, 523.25, 466.16]
for step in range(32):
    note = motif[step % len(motif)]
    tone(note, step * BEAT, 0.27, 0.09 if step % 2 == 0 else 0.055, 9)


# Soft electronic kick, clap and closed hi-hat.
for beat in range(32):
    start = beat * BEAT
    if beat % 4 in (0, 2):
        def kick(t):
            phase = 2 * math.pi * (68 * t + 65 * 0.045 * (1 - math.exp(-t / 0.045)))
            return 0.26 * math.exp(-t * 28) * math.sin(phase)

        mix(start, 0.23, kick)
    if beat % 4 in (1, 3):
        noise = [rng.uniform(-1, 1) for _ in range(int(0.12 * RATE) + 1)]
        mix(start, 0.12, lambda t, n=noise: 0.09 * math.exp(-t * 34) * n[int(t * RATE)])

for step in range(64):
    start = step * BEAT / 2
    noise = [rng.uniform(-1, 1) for _ in range(int(0.055 * RATE) + 1)]
    mix(start, 0.055, lambda t, n=noise: 0.027 * math.exp(-t * 65) * n[int(t * RATE)])


# Airy transition sweeps at the four cuts.
for cut in (2.6, 6.0, 9.2, 12.3):
    noise = [rng.uniform(-1, 1) for _ in range(int(0.42 * RATE) + 1)]
    def sweep(t, n=noise):
        k = t / 0.42
        return 0.052 * math.sin(math.pi * k) * n[int(t * RATE)]

    mix(cut - 0.18, 0.42, sweep)


out = sys.argv[1] if len(sys.argv) > 1 else "/tmp/nexusvora-story-audio.wav"
with wave.open(out, "wb") as wav:
    wav.setnchannels(1)
    wav.setsampwidth(2)
    wav.setframerate(RATE)
    for i, value in enumerate(audio):
        fade = min(1.0, i / (RATE * 0.35), (N - i) / (RATE * 0.65))
        normalized = math.tanh(value * 1.55) * max(0.0, fade) * 0.8
        wav.writeframesraw(struct.pack("<h", round(normalized * 32767)))

print(out)
