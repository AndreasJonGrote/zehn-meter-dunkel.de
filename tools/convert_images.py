#!/usr/bin/env python3
"""
Script zum Konvertieren von JPG zu WebP (lossless) und 
lossless Komprimieren von JPG-Dateien.
"""

import os
from pathlib import Path
from PIL import Image

# Konstante: Pfad zum Ordner (relativ zum Script-Verzeichnis)
SCRIPT_DIR = Path(__file__).parent
FOLDER_PATH = SCRIPT_DIR / "../assets"

def normalize_filename(filename):
	"""
	Normalisiert Dateinamen: lowercase, Leerzeichen zu Unterstrichen.
	"""
	name = filename.stem.lower().replace(' ', '_')
	return filename.parent / f"{name}{filename.suffix.lower()}"

def process_jpg_files(folder_path):
	"""
	Verarbeitet alle JPG-Dateien im angegebenen Ordner.
	Erstellt lossless WebP und komprimiert JPG lossless.
	"""
	folder = Path(folder_path).resolve()
	
	if not folder.exists():
		print(f"Fehler: Ordner '{folder_path}' existiert nicht.")
		return
	
	jpg_files = list(folder.glob("*.jpg")) + list(folder.glob("*.JPG"))
	
	if not jpg_files:
		print(f"Keine JPG-Dateien in '{folder_path}' gefunden.")
		return
	
	print(f"{len(jpg_files)} JPG-Datei(en) gefunden.\n")
	
	for jpg_file in jpg_files:
		try:
			# Dateinamen normalisieren
			normalized_jpg = normalize_filename(jpg_file)
			
			# Datei umbenennen, wenn nötig
			if jpg_file != normalized_jpg:
				if normalized_jpg.exists():
					print(f"⊘ Übersprungen (normalisierte Datei existiert bereits): {normalized_jpg.name}")
					continue
				jpg_file.rename(normalized_jpg)
				jpg_file = normalized_jpg
				print(f"✓ Umbenannt zu: {jpg_file.name}")
			
			webp_path = jpg_file.with_suffix('.webp')
			
			# Nur verarbeiten, wenn noch kein WebP existiert
			if webp_path.exists():
				print(f"⊘ Übersprungen (WebP vorhanden): {jpg_file.name}")
				continue
			
			with Image.open(jpg_file) as img:
				# RGB konvertieren falls nötig
				if img.mode != 'RGB':
					img = img.convert('RGB')
				
				# WebP lossless erstellen
				img.save(webp_path, 'WEBP', lossless=True)
				print(f"✓ WebP erstellt: {webp_path.name}")
				
				# JPG lossless komprimieren (Qualität 100, optimize)
				img.save(jpg_file, 'JPEG', quality=100, optimize=True, progressive=True)
				print(f"✓ JPG komprimiert: {jpg_file.name}")
				
		except Exception as e:
			print(f"✗ Fehler bei {jpg_file.name}: {e}")

if __name__ == "__main__":
	process_jpg_files(FOLDER_PATH)

