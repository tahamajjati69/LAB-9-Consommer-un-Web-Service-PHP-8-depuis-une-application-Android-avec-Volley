package com.example.projetwsx

import android.content.Intent
import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.activity.enableEdgeToEdge
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.material3.Button
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.platform.LocalContext
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import com.example.projetwsx.ui.theme.ProjetwsxTheme

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContent {
            ProjetwsxTheme {
                Scaffold(modifier = Modifier.fillMaxSize()) { innerPadding ->
                    MainScreen(modifier = Modifier.padding(innerPadding))
                }
            }
        }
    }
}

@Composable
fun MainScreen(modifier: Modifier = Modifier) {
    val context = LocalContext.current

    Column(modifier = modifier.padding(16.dp)) {
        Text(text = "Bienvenue dans l'application!")

        Button(
            onClick = {
                // Ouvrir l'activité AddEtudiant
                context.startActivity(Intent(context, AddEtudiant::class.java))
            },
            modifier = Modifier.padding(top = 16.dp)
        ) {
            Text(text = "Ajouter un étudiant")
        }
    }
}

@Preview(showBackground = true)
@Composable
fun MainScreenPreview() {
    ProjetwsxTheme {
        MainScreen()
    }
}