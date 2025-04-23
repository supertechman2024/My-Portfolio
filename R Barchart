# Load necessary libraries
library(ggplot2)
library(dplyr)
library(readr)
library(gridExtra)

# Load the dataset (assuming "superstore.csv" is your dataset)
global_superstore <- read_csv("superstore.csv")

# Ensure correct column names and inspect data
str(global_superstore)

# Convert Sales and Profit columns to numeric if necessary
global_superstore$Sales <- as.numeric(global_superstore$Sales)
global_superstore$Profit <- as.numeric(global_superstore$Profit)

# Remove rows with NA in Profit column
global_superstore <- global_superstore[complete.cases(global_superstore$Profit), ]

# Histogram of Sales
hist_sales <- ggplot(global_superstore, aes(x=Sales)) +
  geom_histogram(binwidth=50, fill="blue", color="white") +
  theme_minimal() +
  labs(title="Distribution of Sales", x="Sales", y="Frequency") +
  theme(axis.text=element_text(size=10), axis.title=element_text(size=12)) +
  scale_x_continuous(limits = c(0, 1000), breaks = seq(0, 1000, by = 100)) +  # Adjust x-axis limits and breaks
  scale_y_continuous(labels = scales::comma)  # Format y-axis labels

# Density Plot of Profit
density_profit <- ggplot(global_superstore, aes(x=Profit)) +
  geom_density(fill="green", alpha=0.5) +
  theme_minimal() +
  labs(title="Density of Profit", x="Profit", y="Density") +
  theme(axis.text=element_text(size=10), axis.title=element_text(size=12)) +
  scale_x_continuous(limits = c(0, 1000))  # Adjust x-axis limits

#Box Plot of Sales by Category
box_sales_category <- ggplot(global_superstore, aes(x=Category, y=Sales, fill=Category)) +
  geom_boxplot() +
  theme_minimal() +
  labs(title="Box Plot of Sales by Category", x="Category", y="Sales") +
  theme(axis.text.x=element_text(angle=45, vjust=1, hjust=1, size=10), 
        axis.text.y=element_text(size=10),
        axis.title=element_text(size=12)) +
  stat_summary(fun.y=median, geom="text", vjust=-15, aes(label=sprintf("%.1f",..y..)), size=3, color="red") +  # Move median text above the plot
  stat_summary(fun.y=median, geom="point", shape=18, size=3, color="red")  # Add median point




# Combine plots into a single page
combined_plots <- grid.arrange(hist_sales, density_profit, box_sales_category, ncol=1)

# Display the combined plot
print(combined_plots)

