#include "filler.h"

int		valid_place(char **grid, int *place, int player, int overlap)
{
	if (!((place[1] >= 0 && place[1] < get_max(grid, 'x')) &&
		(place[0] >= 0 && place[0] < get_max(grid, 'y'))))
		return (-1);
	if (grid[place[0]][place[1]] == 'X' || grid[place[0]][place[1]] == 'x')
	{
		if (player == '2')
			overlap++;
		else
			overlap = -1;
	}
	if (grid[place[0]][place[1]] == 'O' || grid[place[0]][place[1]] == 'o')
	{
		if (player == '1')
			overlap++;
		else
			overlap = -1;
	}
	return (overlap);
}

int		valid_placement(char **grid, char **piece, int *dest, int player)
{
	int m;
	int n;
	int overlap;
	int *coord;

	overlap = 0;
	m = 0;
	while (piece[m] != NULL)
	{
		n = 0;
		while (piece[m][n] != '\0')
		{
			if (piece[m][n] == '*')
			{
				coord = get_coord(m + dest[0], n + dest[1]);
				overlap = valid_place(grid, coord, player, overlap);
				if (overlap == -1)
					return (-1);
			}
			n++;
		}
		m++;
	}
	return (overlap);
}

int		quadrant_check(char **grid, char player)
{
	int x;
	int y;
	int *g_max;
	int quadrant;

	g_max = get_coord(get_max(grid, 'y'), get_max(grid, 'x'));
	y = 0;
	while (grid[y] != NULL)
	{
		x = 0;
		while (grid[y][x] != '\0')
		{
			if (grid[y][x] == player)
			{
				quadrant = 0;
				if (x < (g_max[1] / 2))
					quadrant = 1;
				if (y >= (g_max[0] / 2))
					quadrant += 2;
			}
			x++;
		}
		y++;
	}
	return (quadrant);
}

int		distance_check(char **piece, int pos_y, int pos_x, int *dest)
{
	int distance;
	int temp_dist;
	int x;
	int y;
	int *temp;

	distance = -1;
	y = 0;
	while (piece[y] != NULL)
	{
		x = 0;
		while (piece[y][x] != '\0')
		{
			if (piece[y][x] == '*')
			{
				temp = get_coord((y + pos_y) - dest[0], (x + pos_x) - dest[1]);
				temp_dist = temp[1] * temp[1] + temp[0] * temp[0];
				if (temp_dist < distance || distance == -1)
					distance = temp_dist;
			}
			x++;
		}
		y++;
	}
	return (distance);
}
