using System;
using System.IO;
using System.Security.Cryptography;


    class Datacryption
    {
        private string data;

        public string Data
        {
            get { return data; }
            set { data = value; }
        }

        // Metoda do zaszyfrowania.
        public static byte[] Encrypt(string data, byte[] klucz, byte[] vi)
        {
            try
            {
                // Szyfruj string do tablicy bitow za pomoca ukrytej metody.
                byte[] encrypted = EncryptStringToBytes(data, klucz, vi);

                return encrypted;
            }
            catch (Exception e)
            {
                Console.WriteLine("Error: {0}", e.Message);
                return null;
            }

        }
        // Metoda do rozszyfrowania.
        public static string Decrypt(byte[] data, byte[] klucz, byte[] vi)
        {
            try
            {
                // Rozszyfruj tablicê bitów do stringa za pomoca ukrytej metody.
                string decrypted = DecryptStringFromBytes(data, klucz, vi);

                return decrypted;
            }
            catch (Exception e)
            {
                Console.WriteLine("Error: {0}", e.Message);
                return null;
            }

        }
        private static byte[] EncryptStringToBytes(string plainText, byte[] Key, byte[] IV)
        {
            // Sprawdzam dane wejœciowe
            if (plainText == null || plainText.Length <= 0)
                throw new ArgumentNullException("plainText");
            if (Key == null || Key.Length <= 0)
                throw new ArgumentNullException("Key");
            if (IV == null || IV.Length <= 0)
                throw new ArgumentNullException("IV");
            byte[] encrypted;
            // Tworzê pomocnicz¹ klasê RIJANDAEL
            using (RijndaelManaged rijAlg = new RijndaelManaged())
            {
                rijAlg.Key = Key;
                rijAlg.IV = IV;

                // Jakieœ cryptograficzne fiku miku do zapisywania plików.

                ICryptoTransform encryptor = rijAlg.CreateEncryptor(rijAlg.Key, rijAlg.IV);


                using (MemoryStream msEncrypt = new MemoryStream())
                {
                    using (CryptoStream csEncrypt = new CryptoStream(msEncrypt, encryptor, CryptoStreamMode.Write))
                    {
                        using (StreamWriter swEncrypt = new StreamWriter(csEncrypt))
                        {
                            // Zapis danych 
                            swEncrypt.Write(plainText);
                        }
                        encrypted = msEncrypt.ToArray();
                    }
                }
            }

            return encrypted;
        }
        private static string DecryptStringFromBytes(byte[] cipherText, byte[] Key, byte[] IV)
        {
            // Sprawdzam dane wejœciowe.
            if (cipherText == null || cipherText.Length <= 0)
                throw new ArgumentNullException("cipherText");
            if (Key == null || Key.Length <= 0)
                throw new ArgumentNullException("Key");
            if (IV == null || IV.Length <= 0)
                throw new ArgumentNullException("IV");

            // Deklaracja wyjœciowego stringa.
            string plaintext = null;


            // Pomocnicza klasa Rijandael.
            using (RijndaelManaged rijAlg = new RijndaelManaged())
            {
                rijAlg.Key = Key;
                rijAlg.IV = IV;

                // Znowu jakieœ cryptograficzne fiku miku ale w drug¹ stronê.
                ICryptoTransform decryptor = rijAlg.CreateDecryptor(rijAlg.Key, rijAlg.IV);

                // Streamsy do odczytania tablicy bitów.
                using (MemoryStream msDecrypt = new MemoryStream(cipherText))
                {
                    using (CryptoStream csDecrypt = new CryptoStream(msDecrypt, decryptor, CryptoStreamMode.Read))
                    {
                        using (StreamReader srDecrypt = new StreamReader(csDecrypt))
                        {
                            // Odczytaj tablicê i wpisz j¹ do stringa
                            plaintext = srDecrypt.ReadToEnd();
                        }
                    }
                }
            }

            return plaintext;
        }
    }

